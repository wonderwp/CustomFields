<?php

declare(strict_types=1);

namespace WonderWp\Component\CustomFields\Tests\Fixtures;

use WonderWp\Component\CustomFields\Definition\AbstractCustomFieldsRegistry;
use WonderWp\Component\CustomFields\Service\AbstractCustomFieldsRegistryService;

final class FakeRegistry extends AbstractCustomFieldsRegistry
{
    public function __construct(private string $key, private bool $shouldFail = false)
    {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function register()
    {
        if ($this->shouldFail) {
            throw new \RuntimeException('register failed', 422);
        }

        return true;
    }
}

final class TestableCustomFieldsRegistryService extends AbstractCustomFieldsRegistryService
{
    public function register()
    {
        return true;
    }
}
