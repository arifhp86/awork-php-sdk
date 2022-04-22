<?php

namespace Awork\Api;

use Awork\Collections\TeamCollection;
use Awork\Model\Team as TeamModel;

class Team extends Endpoint
{
    public const ENDPOINT = 'teams';

    public function get(): TeamCollection
    {
        return TeamCollection::fromArray(
            $this->api->get(self::ENDPOINT)->json()
        );
    }

    public function getTeam(string $teamId): TeamModel
    {
        return new TeamModel(
            $this->api->get(sprintf('%s/%s', self::ENDPOINT, $teamId))->json()
        );
    }

    public function create(array $data): TeamModel
    {
        return new TeamModel(
            $this->api->post(self::ENDPOINT, $data)->json()
        );
    }

    public function addProject(string $teamId, string $projectId)
    {
        return $this->api->post(sprintf('%s/%s/addprojects', self::ENDPOINT, $teamId), [$projectId]);
    }
}