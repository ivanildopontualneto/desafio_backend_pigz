<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TarefaRepository;
use App\Repository\ListaRepository;
use App\Entity\Tarefa;

class TarefaController extends AbstractController
{   
    #<-- Endpoint que lista todas as tarefas
    #[Route('/tarefas', name: 'tarefas_list', methods: ['GET'])]
    public function index(TarefaRepository $tarefaRepository): JsonResponse
    {
        return $this->json([
            'data' => $tarefaRepository->findAll(),
        ]);
    }

    #<-- Endpoint que cria novas tarefas para listas já cadastradas-->
    #[Route('/tarefas', name: 'tarefas_create', methods: ['POST'])]
    public function create(Request $request, TarefaRepository $tarefaRepository, ListaRepository $listaRepository): JsonResponse
    {
        $data = $request->request->all();

        $tarefa = new Tarefa();
        $tarefa->setDescricaoTarefa($data['descricao_tarefa']);

        $listas = $listaRepository->findAll();

        foreach ($listas as $lista) {
            if ($lista->getId() == $data['id_tarefa']) $tarefa->setLista($lista);
        }
        
        if (!$lista) throw $this->createNotFoundException();
        
        $tarefaRepository->save($tarefa, true);

        return $this->json([
            'message' => 'Tarefa criada com sucesso!',
        ], 201);
    }     

    
}