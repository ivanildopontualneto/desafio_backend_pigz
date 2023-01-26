<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ListaRepository;
use App\Repository\TarefaRepository;
use App\Entity\Lista;
use App\Entity\Tarefa;

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
    public function create(Request $request, ListaRepository $listaRepository, TarefaRepository $tarefaRepository): JsonResponse
    {
        $data = $request->request->all();

        $lista = new Lista();
        $lista->setDescricaoLista($data['descricao']);
        
        if(isset($data['tarefas'])){
            foreach($data['tarefas'] as $tarefa){
                $taflista = new Tarefa();
                
                $this->$tarefaRepository;

                $taflista->setDescricaoTarefa($tarefa['descricao']);
                $taflista->setStatusTarefa($tarefa['status']);
                $lista->addTarefa($taflista);
            }
        }
        //$tarefa->setDescricaoTarefa(['descricao_tarefa']);
        //$tarefa->setStatusTarefa('status_tarefa');
        //$tarefa->setLista('lista_tarefa');

        
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
}
