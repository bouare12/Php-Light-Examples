<?php

namespace UserBundle\Controller;

use PhpLight\Framework\Controller\Controller;
use PhpLight\Http\Request\Request;
use PhpLight\Http\Response\JsonResponse;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

class UserController extends Controller
{
    public function newAction(Request $request)
    {
        $userRepository = new UserRepository();

        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {

            $user = new User($request->getPost()["user"]);

            if ($userRepository->create($user)) {
                return new JsonResponse([
                    "success" => true,
                    "message" => "L'utilisateur a bien été ajouté",
                    "user" => $user->toArray()
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "Erreur. L'utilisateur n'a pu être ajouter. Vérifier vos droits d'accès ou contacter le support"
                ]);
            }
        }

        return new JsonResponse([
            "success" => true,
            "message" => "Affichage du formulaire"
        ]);
    }

        public function listAction()
    {
        $userRepository = new UserRepository();
        $usersObjects = $userRepository->listAll();
        $users = [];
        if ($usersObjects) {
            foreach ($usersObjects as $userObject) {
                $users[] = $userObject->toArray();
            }
            return new JsonResponse([
                "success" => true,
                "message" => "La liste des utilisateurs est bien affiché",
                "users" => $users
            ]);
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "Erreur"
            ]);
        }
    }
}

