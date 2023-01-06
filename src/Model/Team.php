<?php

namespace Awork\Model;

class Team extends Model
{
    private string $id;
    private string $name;
    private string $icon;
    private string $color;
    private array $userIds = [];
    private array $projectIds = [];

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->icon = $data['icon'] ?? '';
        $this->color = $data['color'] ?? '';
        $this->userIds = $data['userIds'] ?? [];
        $this->projectIds = $data['projectIds'] ?? [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getUserIds(): array
    {
        return $this->userIds;
    }

    public function getProjectIds(): array
    {
        return $this->projectIds;
    }
}
