<?php

namespace App\Controller\Media;

use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\MediaObject;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateMediaObject
{
    private $managerRegistry;
    private $validator;
    private $resourceMetadataFactory;

    public function __construct(
        ManagerRegistry $managerRegistry,
        ValidatorInterface $validator,
        ResourceMetadataFactoryInterface $resourceMetadataFactory
    ) {
        $this->managerRegistry = $managerRegistry;
        $this->validator = $validator;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
    }

    /**
     * @param Request $request
     *
     * @return MediaObject
     *
     * @throws \ApiPlatform\Core\Exception\ResourceClassNotFoundException
     */
    public function __invoke(Request $request): MediaObject
    {
        $uploadedFile = $request->files->get('file');

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;

        $this->validate($mediaObject, $request);

        $em = $this->managerRegistry->getManager();
        $em->persist($mediaObject);
        $em->flush();

        return $mediaObject;
    }

    /**
     * @throws ValidationException
     * @throws \ApiPlatform\Core\Exception\ResourceClassNotFoundException
     */
    private function validate(MediaObject $mediaObject, Request $request): void
    {
        $attributes = RequestAttributesExtractor::extractAttributes($request);
        $resourceMetadata = $this->resourceMetadataFactory->create(MediaObject::class);
        $validationGroups = $resourceMetadata->getOperationAttribute($attributes, 'validation_groups', null, true);

        $this->validator->validate($mediaObject, ['groups' => $validationGroups]);
    }
}
