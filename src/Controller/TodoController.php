<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\TodoList;
use App\Entity\Todo;
use App\Form\TodoType;

class TodoController extends AbstractController
{
    public function new(int $id): Response
    {
        $form = $this->createForm(TodoType::class, null, ["action" => $this->generateUrl("create_todo", ["id" => $id])]);
        
        return $this->render('todo/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function create(TodoList $list, Request $request): Response
    {
        $todo = new Todo($list);
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);
        if($form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($todo);
            $manager->flush();
        }
        return $this->redirectToRoute("list", ["id" => $list->getId()]);
        
    }



}
