<?php

namespace WonderWp\Component\CustomFields\Definition;

abstract class AbstractCustomFieldsRegistry implements CustomFieldsRegistryInterface
{
    abstract public function getKey(): string;

    public function register()
    {
        return true;
    }
}
