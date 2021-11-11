<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\TodoList;

class TodoListController extends AbstractController
{
    public function index(): Response
    {
        $todoLists = $this->getDoctrine()->getRepository(TodoList::class)->findAll();
        return $this->render('todo_list/index.html.twig', [
            'todoLists' => $todoLists
        ]);
    }
}
