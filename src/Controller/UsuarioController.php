<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsuarioRepository;
use App\Entity\Usuario;

class UsuarioController extends AbstractController
{
    //Index dos Usuários
    #[Route('/usuarios', name: 'usuarios_list', methods: ['GET'])]
    public function index(UsuarioRepository $usuarioRepository): JsonResponse
    {
        return $this->json([
            'data' => $usuarioRepository->findAll(),
        ]);
    }

    //Criação de Usuários
    #[Route('/usuarios', name: 'usuarios_create', methods: ['POST'])]
    public function create(Request $request, UsuarioRepository $usuarioRepository): JsonResponse
    {
        $data = $request->request->all();

        $usuario = new Usuario();
        $usuario->setEmail($data['email']);
        $usuario->setNome($data['nome']);
        $usuario->setRoles(array($data['role']));
        $usuario->setPassword($data['password']);
        
        $usuarioRepository->save($usuario, true);

        return $this->json([
            'message' => 'Usuário criado com sucesso!'
        ], 200);
    }

    //Exibir Usuário por Id
    #[Route('/usuarios/{usuario}', name: 'usuarios_single', methods: ['GET'])]
    public function singleUsuario(int $usuario, usuarioRepository $usuarioRepository): JsonResponse
    {   
        $usuario = $usuarioRepository->find($usuario);
    
        if(!$usuario) throw $this->createNotFoundException();
    
        return $this->json([
            'data' => $usuario,
        ]);
    }

    //Remoção de Usuários
    #[Route('/usuarios/{usuario}', name: 'usuarios_delete', methods: ['POST'])]
    public function deleteUsuario(int $usuario, UsuarioRepository $usuarioRepository): JsonResponse
    {   
        $usuario = $usuarioRepository->find($usuario);

        if(!$usuario) throw $this->createNotFoundException();

        $usuario = $usuarioRepository->remove($usuario, true);

        return $this->json([
            'message' => 'Usuario removido com sucesso!'
        ], 200);
    }
}
