<?php

namespace Awork\Collections;

use Awork\Model\Company;
use Illuminate\Support\Collection;


class CompanyCollection extends Collection
{
    /** @var Company[] */
    protected $items = [];

    public static function fromArray(array $items): self
    {
        return new self(array_map(fn ($item) => new Company($item), $items));
    }
}