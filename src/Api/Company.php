<?php

namespace Awork\Api;

use Awork\Collections\CompanyCollection;
use Awork\Model\Company as CompanyModel;

class Company extends Endpoint
{
    public const ENDPOINT = 'companies';

    public function get(): CompanyCollection
    {
        return CompanyCollection::fromArray(
            $this->api->get(self::ENDPOINT)->json()
        );
    }

    public function getCompany(string $companyId): CompanyModel
    {
        return new CompanyModel(
            $this->api->get(sprintf('%s/%s', self::ENDPOINT, $companyId))->json()
        );
    }

    public function create(array $data): CompanyModel
    {
        return new CompanyModel(
            $this->api->post(self::ENDPOINT, $data)->json()
        );
    }
}