<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'task_index')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => ['Task 1', 'Task 2', 'Task 3'],
        ]);
    }
}
