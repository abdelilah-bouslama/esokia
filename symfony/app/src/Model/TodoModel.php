<?php

namespace App\Model;

use App\Entity\Todo;
use App\Repository\TodoRepository;

class TodoModel
{
    public function __construct(private TodoRepository $repo)
    {
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->repo->findAll();
    }

    /**
     * @param array $data
     * 
     * @return Todo
     */
    public function addEdit(array $data): Todo
    {
        $entity = !empty($data['id']) ? $this->repo->find($data['id']) : new Todo();
        foreach($data as $name => $value) {
            $entity->{'set'.ucfirst($name)}($value);
        }
        $this->repo->add($entity);

        return $entity;
    }

    /**
     * @param array $id
     *
     * @return void
     */
    public function remove(array $ids): void
    {
        foreach ($ids as $id) {
            $this->repo->remove($this->repo->find($id));
        }
    }
}
