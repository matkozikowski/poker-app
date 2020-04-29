<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ApiAuthController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function register(Request $request): Response
    {
        $errors = [];
        $email = $request->request->get("email");
        $password = $request->request->get("password");

        if (strlen($password) < 6) {
            $errors[] = "Password should be at least 6 characters.";
        }

        if (!$errors) {
            $user = new User();
            $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);
            $user->setEmail($email);
            $user->setPassword($encodedPassword);
            $user->setRoles(['ROLE_USER']);
            $user->setApiToken(bin2hex(random_bytes(60)));

            try {
                $this->userRepository->save($user);

                return $this->json(
                    [
                        'token' => $user->getApiToken(),
                    ]
                );
            } catch (UniqueConstraintViolationException $e) {
                $errors[] = "The email provided already has an account!";
            } catch (\Exception $e) {
                $errors[] = "Unable to save new user at this time.";
            }
        }

        return $this->json(
            [
                'errors' => $errors
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    public function login(): Response
    {
        return new JsonResponse(
            [
                'status' => true
            ]
        );
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function profile(): Response
    {
        return $this->json(
            [
                'user' => $this->getUser()->getUsername(),
            ],
            Response::HTTP_OK,
            [],
            [
                'groups' => ['api']
            ]
        );
    }
}
