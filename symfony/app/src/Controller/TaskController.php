<?php

namespace App\Controller;

use App\Model\TodoModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
    public function addEdit(Request $request, TodoModel $model): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(status:400);
        }
        try {
            return new JsonResponse(
                $model->addEdit($request->request->all())->toArray()
            );
        } catch (\Throwable $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage()
                ]
                ,
                $e->getCode() != 0 ? $e->getCode() : 500
            );
        }
    }

    public function remove(Request $request, TodoModel $model): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(status:400);
        }

        try {
            $model->remove($request->request->get('ids', []));
            return new JsonResponse([]);
        } catch (\Throwable $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage()
                ]
                ,
                $e->getCode() != 0 ? $e->getCode() : 500
            );
        }
    }
}
