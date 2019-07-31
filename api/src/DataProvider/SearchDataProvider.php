<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Dto\Search;
use App\Repository\BookRepository;

final class SearchDataProvider implements ItemDataProviderInterface
{
    /** @var BookRepository */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getItem(string $resourceClass, $searchText, string $operationName = null, array $context = [])
    {
        if (Search::class !== $resourceClass) {
            throw new ResourceClassNotSupportedException();
        }

        $books = $this->bookRepository->searchBookByTitleOrAuthorName($searchText);

        return new Search($searchText, $books);
    }
}
