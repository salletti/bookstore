<?php

declare(strict_types=1);

namespace App\Dto;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "path"="/books/search/{id}",
 *              "swagger_context"={
 *                  "tags"={"Book"}
 *              }
 *          }
 *      },
 *      collectionOperations={}
 *  )
 */
final class Search
{
    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     *
     * @Assert\NotBlank()
     *
     * @Groups({"read"})
     */
    private $text;

    /**
     * @var array|null
     *
     * @Groups({"read"})
     */
    private $searchResult = [];

    public function __construct(string $text, ?array $searchResult)
    {
        $this->text = $text;
        $this->searchResult = $searchResult;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getSearchResult(): ?array
    {
        return $this->searchResult;
    }
}
