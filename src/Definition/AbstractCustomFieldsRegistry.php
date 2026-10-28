<?php

namespace WonderWp\Component\CustomFields\Definition;

abstract class AbstractCustomFieldsRegistry implements CustomFieldsRegistryInterface
{
    /**
     * Default key = FQCN. Prefer overriding with a stable short key in concrete registries.
     */
    public function getKey(): string
    {
        return static::class;
    }

    public function register()
    {
        return true;
    }
}
