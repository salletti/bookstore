<?php

namespace App\Controller\Book;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book/list", name="booklist")
 */
final class BookList extends AbstractController
{
    public function __invoke(
        BookRepository $bookRepository
    ) {
        $books = $bookRepository->findAll();

        return $this->render(
            'book/booklist.html.twig',
            ['books' => $books]
        );
    }
}
