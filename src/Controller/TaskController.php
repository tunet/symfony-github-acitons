<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\TaskSorter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tasks')]
class TaskController extends AbstractController
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskSorter $taskSorter,
    ) {
    }

    #[Route('/', name: 'app_task_list')]
    public function index(): Response
    {
        $tasks = $this->taskRepository->findAll();
        $sortedTasks = $this->taskSorter->sort($tasks);

        return $this->render('task/index.html.twig', [
            'tasks' => $sortedTasks,
        ]);
    }

    #[Route('/add', name: 'app_task_add')]
    public function add(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $task = new Task();
            $task
                ->setTitle($request->request->get('title'))
                ->setDescription($request->request->get('description'))
            ;
            $this->taskRepository->save($task, true);

            return $this->redirectToRoute('app_task_list');
        }

        return $this->render('task/add.html.twig');
    }
}
