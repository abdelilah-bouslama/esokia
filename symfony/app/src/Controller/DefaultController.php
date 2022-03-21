<?php

namespace App\Controller;

use App\Model\TodoModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(TodoModel $todoModel): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'tasks' => $todoModel->findAll()
        ]);
    }
}
