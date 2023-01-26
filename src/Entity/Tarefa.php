<?php

namespace App\Entity;

use App\Repository\TarefaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarefaRepository::class)]
#[ORM\Table(name: 'tarefas')]
class Tarefa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao_tarefa = null;

    #[ORM\Column]
    private ?int $status_tarefa = null;

    #[ORM\ManyToOne(inversedBy: 'tarefas')]
    private ?Lista $lista = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricaoTarefa(): ?string
    {
        return $this->descricao_tarefa;
    }

    public function setDescricaoTarefa(string $descricao_tarefa): self
    {
        $this->descricao_tarefa = $descricao_tarefa;

        return $this;
    }

    public function getStatusTarefa(): ?int
    {
        return $this->status_tarefa;
    }

    public function setStatusTarefa(int $status_tarefa): self
    {
        $this->status_tarefa = $status_tarefa;

        return $this;
    }

    public function getLista(): ?Lista
    {
        return $this->lista;
    }

    public function setLista(?Lista $lista): self
    {
        $this->lista = $lista;

        return $this;
    }
}
