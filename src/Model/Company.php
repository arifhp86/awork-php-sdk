<?php

namespace Awork\Model;

use Awork\Collections\TagCollection;

class Company extends Model
{
    private string $id;
    private string $name;
    private ?TagCollection $tags;
    private array $data;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->tags = isset($data['tags']) ? TagCollection::fromArray($data['tags']) : null;
        $this->data = $data;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTags(): ?TagCollection
    {
        return $this->tags;
    }
}
