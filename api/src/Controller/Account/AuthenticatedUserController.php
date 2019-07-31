<?php

declare(strict_types=1);

namespace App\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/authenticated-user", name="app_authenticated_user")
 */
final class AuthenticatedUserController extends AbstractController
{
    public function __invoke(SerializerInterface $serializer)
    {
        $user = $this->getUser();

        return $user ?
            new Response($serializer->serialize($user, 'json')) :
            new Response('user not authenticated')
        ;
    }
}
