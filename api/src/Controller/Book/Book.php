<?php

namespace App\Controller\Book;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book/{id}", name="book", requirements={"id"="\d+"})
 */
final class Book extends AbstractController
{
    public function __invoke(
        BookRepository $bookRepository,
        string $id
    ) {
        $book = $bookRepository->find($id);

        return $this->render(
            'book/book.html.twig',
            ['book' => $book]
        );
    }
}
