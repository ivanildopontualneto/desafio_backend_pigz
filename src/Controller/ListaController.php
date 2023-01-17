<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ListaRepository;
use App\Entity\Lista;

class ListaController extends AbstractController
{
    //Index das Listas
    #[Route('/listas', name: 'listas_list', methods: ['GET'])]
    public function index(ListaRepository $listaRepository): JsonResponse
    {
        return $this->json([
            'data' => $listaRepository->findAll(),
        ]);
    }

    //Criação de Listas
    #[Route('/listas', name: 'listas_create', methods: ['POST'])]
    public function create(Request $request, ListaRepository $listaRepository): JsonResponse
    {
        $data = $request->request->all();

        $lista = new Lista();
        $lista->setDescricaoLista($data['descricao_lista']);
        $lista->setUsuarioId($data['usuario_id']);

        $tarefa = new Tarefa();
        $tarefa->setDescricaoTarefa($data['descricao_tarefa']);
        $tarefa->setListaId($data['lista_id']);
        $tarefa->setStatusTarefa($data['status_tarefa']);

        $lista->setTarefaId($data['tarefa_id']);
        
        $listaRepository->save($lista, true);

        return $this->json([
            'message' => 'Lista criada com sucesso!'
        ], 200);
    }

    //Exibir Lista por Id
    #[Route('/listas/{lista}', name: 'listas_single', methods: ['GET'])]
    public function singleLista(int $lista, ListaRepository $listaRepository): JsonResponse
    {   
        $lista = $listaRepository->find($lista);

        if(!$lista) throw $this->createNotFoundException();

        return $this->json([
            'data' => $lista,
        ]);
    }

    //Remoção de Lista
    #[Route('/listas/{lista}', name: 'listas_delete', methods: ['POST'])]
    public function deleteLista(int $lista, ListaRepository $listaRepository): JsonResponse
    {   
        $lista = $listaRepository->find($lista);
    
        if(!$lista) throw $this->createNotFoundException();
    
        $lista = $listaRepository->remove($lista, true);
    
        return $this->json([
            'message' => 'Lista removida com sucesso!'
        ], 200);
    }

    //Adicionar Tarefa na Lista
    #[Route('/listas/{lista}', name: 'listas_tarefas', methods: ['POST'])]
    public function adicionarTarefa(int $lista, ListaRepository $listaRepository): JsonResponse
    {   
        $lista = $listaRepository->find($lista);

        if(!$lista) throw $this->createNotFoundException();

        $tarefa = new Tarefa();
        $tarefa->setDescricaoTarefa($data['descricao']);

        return $this->json([
            'data' => $lista,
        ]);
    }

    //Remover Tarefa na Lista
    #[Route('/listas/{lista}', name: 'listas_tarefas', methods: ['POST'])]
    public function removerTarefa(int $lista, ListaRepository $listaRepository): JsonResponse
    {   
        $lista = $listaRepository->find($lista);

        if(!$lista) throw $this->createNotFoundException();

        $lista = $tarefaRepository->remove($lista, true);

        return $this->json([
            'data' => $lista,
        ]);
    }
}
