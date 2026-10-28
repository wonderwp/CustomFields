<?php

declare(strict_types=1);

namespace WonderWp\Component\CustomFields\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WonderWp\Component\CustomFields\Response\CustomFieldsRegistryRegistrationResponseInterface;
use WonderWp\Component\CustomFields\Tests\Fixtures\FakeRegistry;
use WonderWp\Component\CustomFields\Tests\Fixtures\TestableCustomFieldsRegistryService;

final class AbstractCustomFieldsRegistryServiceTest extends TestCase
{
    private TestableCustomFieldsRegistryService $service;

    protected function setUp(): void
    {
        $this->service = new TestableCustomFieldsRegistryService();
    }

    public function testAddGetRemoveRegistry(): void
    {
        $registry = new FakeRegistry('demo');
        $this->service->addCustomFieldsRegistry($registry);

        $this->assertSame($registry, $this->service->getCustomFieldsRegistry('demo'));
        $this->assertCount(1, $this->service->getCustomFieldsRegistries());

        $this->service->removeCustomFieldsRegistry('demo');
        $this->assertNull($this->service->getCustomFieldsRegistry('demo'));
    }

    public function testSetCustomFieldsRegistriesReplacesCollection(): void
    {
        $a = new FakeRegistry('a');
        $b = new FakeRegistry('b');
        $this->service->setCustomFieldsRegitries(['a' => $a, 'b' => $b]);

        $this->assertSame(['a' => $a, 'b' => $b], $this->service->getCustomFieldsRegistries());
    }

    public function testRegisterCustomFieldsRegistrySuccess(): void
    {
        $response = $this->service->registerCustomFieldsRegistry(new FakeRegistry('ok'));
        $this->assertSame(200, $response->getCode());
        $this->assertSame(CustomFieldsRegistryRegistrationResponseInterface::SUCCESS, $response->getMsgKey());
    }

    public function testRegisterCustomFieldsRegistryError(): void
    {
        $response = $this->service->registerCustomFieldsRegistry(new FakeRegistry('bad', true));
        $this->assertSame(422, $response->getCode());
        $this->assertSame(CustomFieldsRegistryRegistrationResponseInterface::ERROR, $response->getMsgKey());
        $this->assertInstanceOf(\Throwable::class, $response->getError());
    }

    public function testRegisterCustomFieldsRegistriesKeyedByGetKey(): void
    {
        $this->service->addCustomFieldsRegistry(new FakeRegistry('one'));
        $this->service->addCustomFieldsRegistry(new FakeRegistry('two'));

        $responses = $this->service->registerCustomFieldsRegistries();
        $this->assertArrayHasKey('one', $responses);
        $this->assertArrayHasKey('two', $responses);
        $this->assertSame(200, $responses['one']->getCode());
    }
}
