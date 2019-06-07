<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book/{id}/publish/comment", name="new-comment-publisher", requirements={"id"="\d+"})
 */
final class NewCommentPublisherController extends AbstractController
{
    public function __invoke(
        Publisher $publisher,
        int $id
    ): Response {
        $update = new Update(
            sprintf('https://localhost:8443/books/%s/comments', $id),
            json_encode(['listComment' => 'updated'])
        );

        // The Publisher service is an invokable object
        $publisher($update);

        return new Response('new comment published');
    }
}
