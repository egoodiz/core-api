<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{
    #[Route('/health', name: 'health', methods: ['GET'])]
    public function health(): JsonResponse
    {
        return $this->json([
            'status' => 'ok',
            'service' => 'core-api',
            'timestamp' => time()
        ]);
    }

    #[Route('/users', name: 'users_list', methods: ['GET'])]
    public function listUsers(): JsonResponse
    {
        // Example data - replace with database query later
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
        ];

        return $this->json($users);
    }

    #[Route('/users/{id}', name: 'users_show', methods: ['GET'])]
    public function showUser(int $id): JsonResponse
    {
        // Example - replace with database query later
        $user = [
            'id' => $id,
            'name' => 'User ' . $id,
            'email' => "user{$id}@example.com"
        ];

        return $this->json($user);
    }
}
