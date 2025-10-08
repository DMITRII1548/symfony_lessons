<?php

namespace App\Validator\Constraint;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class EntiryExists extends Constraint
{
    public string $entity;
    public string $message = 'Entity {{ entity }} with ID {{ id }} does not exists';

    public function __construct(string $entity, mixed $options = null, ?array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
        $this->entity = $entity;
    }

    public function validatedBy(): string
    {
        return EntityExistsValidator::class;
    }
}