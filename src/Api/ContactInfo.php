<?php

namespace Awork\Api;

use Awork\Collections\ContactInfoCollection;
use Awork\Model\ContactInfo as ContactInfoModel;

class ContactInfo extends Endpoint
{
    public const ENDPOINT = 'companies/%s/contactinfo';

    public function get(string $companyId): ContactInfoCollection
    {
        return ContactInfoCollection::fromArray(
            $this->api->get(sprintf(self::ENDPOINT, $companyId))->json()
        );
    }

    public function create(string $companyId, array $data): ContactInfoModel
    {
        return new ContactInfoModel(
            $this->api->post(sprintf(self::ENDPOINT, $companyId), $data)->json()
        );
    }
}