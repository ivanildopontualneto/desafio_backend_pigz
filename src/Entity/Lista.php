<?php

namespace App\Entity;

use App\Repository\ListaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListaRepository::class)]
#[ORM\Table(name: 'listas')]
class Lista
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao_lista = null;

    #[ORM\Column]
    private array $usuario_id = [];

    #[ORM\Column]
    private array $tarefa_id = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricaoLista(): ?string
    {
        return $this->descricao_lista;
    }

    public function setDescricaoLista(string $descricao_lista): self
    {
        $this->descricao_lista = $descricao_lista;

        return $this;
    }

    public function getUsuarioId(): array
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(array $usuario_id): self
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    public function getTarefaId(): array
    {
        return $this->tarefa_id;
    }

    public function setTarefaId(array $tarefa_id): self
    {
        $this->tarefa_id = $tarefa_id;

        return $this;
    }
}
