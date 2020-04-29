<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports(Request $request): bool
    {
        return 'api_login' === $request->get('_route') && $request->isMethod('POST');
    }

    public function getCredentials(Request $request): array
    {
        return [
            'token' => $request->request->get('token'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (null === $credentials) {
            return null;
        }

        return $this->em->getRepository(User::class)->findOneBy(['apiToken' => $credentials['token']]);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return $this->isTokenValid($user, $credentials['token']);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): Response
    {
        return new JsonResponse([
            'result' => true
        ]);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        $data = [
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }

    private function isTokenValid(User $user, string $token): bool
    {
        return $user->getApiToken() === $token;
    }

}