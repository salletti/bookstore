<?php

namespace App\Normalizer;

use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SwaggerDecorator implements NormalizerInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function normalize($object, $format = null, array $context = [])
    {

        $customDocumentation = $this->getCustomDocumentation();

        $docs = $this->decorated->normalize($object, $format, $context);

        return array_merge_recursive($customDocumentation, $docs);
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    private function getCustomDocumentation(): array
    {
        $customDocumentation = [
            'paths' => [
                '/api/authentication_token' => [
                    'post' => [
                        'tags' => ['Authentication'],
                        'summary' => 'Performs a login attempt, returning a valid token on success',
                        'parameters' => [
                            [
                                'in' => 'body',
                                'name' => 'body',
                                'description' => 'Login payload',
                                'required' => true,
                                'schema' => [
                                    'type' => 'object',
                                    'required' => [
                                        'email',
                                        'password'
                                    ],
                                    'properties' => [
                                        'email' => [
                                            'type' => 'string'
                                        ],
                                        'password' => [
                                            'type' => 'string'
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        'responses' => [
                            200 => [
                                'description' => 'JWT token'
                            ],
                            401 => [
                                'description' => 'Bad credentials'
                            ],
                            400 => [
                                'description' => 'Bad request'
                            ],
                        ],
                    ]
                ]
            ]
        ];

        return $customDocumentation;
    }
}
