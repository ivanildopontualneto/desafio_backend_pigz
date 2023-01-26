<?php

namespace App\Entity;

use App\Repository\ListaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'lista', targetEntity: Tarefa::class)]
    private Collection $tarefas;

    #[ORM\ManyToMany(targetEntity: Usuario::class, inversedBy: 'listas')]
    private Collection $usuario;

    public function __construct()
    {
        $this->tarefas = new ArrayCollection();
        $this->usuario = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Tarefa>
     */
    public function getTarefas(): Collection
    {
        return $this->tarefas;
    }

    public function addTarefa(Tarefa $tarefa): self
    {
        if (!$this->tarefas->contains($tarefa)) {
            $this->tarefas->add($tarefa);
            $tarefa->setLista($this);
        }

        return $this;
    }

    public function removeTarefa(Tarefa $tarefa): self
    {
        if ($this->tarefas->removeElement($tarefa)) {
            // set the owning side to null (unless already changed)
            if ($tarefa->getLista() === $this) {
                $tarefa->setLista(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, usuario>
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function addUsuario(usuario $usuario): self
    {
        if (!$this->usuario->contains($usuario)) {
            $this->usuario->add($usuario);
        }

        return $this;
    }

    public function removeUsuario(usuario $usuario): self
    {
        $this->usuario->removeElement($usuario);

        return $this;
    }
}    
