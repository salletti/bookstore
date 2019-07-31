<template>
    <div id="comments" class="mt-4">
        <div id="comments-form" class="border form-comment">
            <h4>Post a comment</h4>
            <hr/>
            <p v-if="sent"> Thanks for commenting!</p>
            <form v-else @submit.prevent="onSubmit">
                <div class="form-group">
                    <div>
                        <label for="author">Name</label>
                        <input v-model="author" name="author" id="author" class="form-control">
                    </div>
                    <div>
                        <label for="comment">Comment</label>
                        <textarea v-model="comment" name="comment" id="comment" class="form-control"></textarea>
                    </div>
                    <div class="row" id="submit-button">
                        <input type="submit" :disabled='!author || !comment' value="Post Comment"
                               class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div id="comments-list" class="row mt-4">
            <div class="col">
                <div v-for="c in commentList" v-bind:key="c.id" class="alert alert-info">
                    <h4>
                        <i class="fas fa-user"></i>
                        {{ c.name }}
                        <small><i>Posted on {{ c.createdAt | formatDate }}</i></small>
                    </h4>
                    <hr>
                    <p class="mb-0">{{ c.text }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: 'Comments',
        props: ['bookId'],
        data() {
            return {
                author: '',
                comment: '',
                commentList: [],
                sent: false,
                headers: {}
            }
        },
        created() {
            console.log('Comments.vue created');

            this.headers = new Headers();
            this.headers.append('Authorization', this.$store.getters.getToken);
            this.headers.append('Content-Type', 'application/ld+json')
            this.fetchComments();

            const u = new URL('http://localhost:1337/hub');
            u.searchParams.append('topic', 'https://localhost:8443/books/' + this.bookId + '/comments');

            const es = new EventSource(u);
            es.onmessage = e => {
                console.log('data: ');
                console.log(JSON.parse(e.data));
                this.fetchComments();
            }
        },
        filters: {
            formatDate(value) {
                return moment(String(value)).format('DD/MM/YYYY hh:mm')
            }
        },
        methods: {
            fetchComments() {
                fetch('/api/books/' + this.bookId + '/comments', {headers: this.headers})
                    .then(response => response.json())
                    .then(data => {
                        this.commentList = data['hydra:member'];
                        console.log("commentList: " + this.commentList);
                    })
            },
            publishTopic() {
                fetch('/book/' + this.bookId + '/publish/comment')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
            },
            onSubmit() {
                console.log('onSubmit');
                fetch('/api/comments/', {
                    method: 'POST',
                    headers: this.headers,
                    body: JSON.stringify({
                        'book': "/api/books/" + this.bookId,
                        'name': author.value,
                        'text': comment.value,
                        'createdAt': moment().format('YYYY-MM-DDThh:mm')
                    })
                }).then(() => {
                    this.sent = true;
                    this.fetchComments();
                    this.publishTopic();
                });
            }
        }
    }
</script>

<style scoped>
    #submit-button {
        margin: 20px 0;
    }

    .form-comment {
        padding: 30px 30px 0;
    }
</style>

