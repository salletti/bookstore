<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function searchBookByTitleOrAuthorName(string $text)
    {
        $qb = $this->createQueryBuilder('b')
            ->where('b.title LIKE :title')
            ->setParameter('title', '%'.$text.'%')
            ->orWhere('b.author LIKE :author')
            ->setParameter('author', '%'.$text.'%')
            ->getQuery();

        return $qb->execute();
    }
}
