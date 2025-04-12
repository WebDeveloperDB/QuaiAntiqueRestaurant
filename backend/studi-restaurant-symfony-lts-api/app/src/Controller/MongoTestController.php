<?php

namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/mongo')]
class MongoTestController extends AbstractController
{
    #[Route('/add-user', name: 'mongo_add_user', methods: ['POST'])]
    public function addUser(DocumentManager $dm, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['name']) || !isset($data['email'])) {
            return new JsonResponse(['error' => 'Missing data'], 400);
        }

        $user = new User($data['name'], $data['email']);

        $dm->persist($user);
        $dm->flush();

        return new JsonResponse(['message' => 'User added successfully', 'id' => $user->getId()], 201);
    }
}