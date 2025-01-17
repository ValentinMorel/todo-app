<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'task_index', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Fetch all tasks
        $tasks = $entityManager->getRepository(Task::class)->findAll();
    
        // Handle the form submission for toggling the "isCompleted" status
        if ($request->isMethod('POST')) {
            $taskId = $request->request->get('task_id');
            $task = $entityManager->getRepository(Task::class)->find($taskId);
    
            if ($task) {
                $task->setIsCompleted(!$task->getIsCompleted());
                $entityManager->flush();
            }
    
            return $this->redirectToRoute('task_index');
        }
    
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }
  

    #[Route('/tasks/new', name: 'task_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('task_index');
        }

        return $this->render('task/new.html.twig', ['form' => $form->createView()]);
    }

}

