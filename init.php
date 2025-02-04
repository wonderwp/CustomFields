<?php

use WonderWp\Component\CustomFields\Service\CustomFieldsRegistryService;
use WonderWp\Component\CustomFields\Service\CustomFieldsRegistryServiceInterface;
use WonderWp\Component\PluginSkeleton\Exception\ServiceNotFoundException;
use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\Service\ServiceInterface;
use WonderWp\Component\PluginSkeleton\ManagerInterface;
use WonderWp\Component\DependencyInjection\Container;

add_action('wonderwp.loader.load', 'wwp_register_customfields_definitions_towards_container', 10, 2);
add_action('wwp.abstract_manager.run', 'wwp_register_customfields_service_towards_manager', 10, 2);

function wwp_register_customfields_definitions_towards_container(Container $container)
{
    $container['wwp.customfields.defaultService'] = $container->factory(function () {
        return new CustomFieldsRegistryService();
    });
}

function wwp_register_customfields_service_towards_manager(ManagerInterface $manager, Container $container)
{
    //Custom Fields
    try {
        $customFieldService = $manager->getService(ServiceInterface::CUSTOM_FIELDS_SERVICE_NAME);
        if ($customFieldService instanceof CustomFieldsRegistryServiceInterface) {
            $customFieldService->register();
        }
    } catch (ServiceNotFoundException $e) {
        if ($e->getServiceType() === ServiceInterface::CUSTOM_FIELDS_SERVICE_NAME) {
            //No custom field service found, use the default one instead
            $customFieldService = $container['wwp.customfields.defaultService'];
            if ($customFieldService instanceof CustomFieldsRegistryServiceInterface) {
                if ($customFieldService instanceof ManagerAwareInterface) {
                    $customFieldService->setManager($manager);
                }
                $customFieldService->register();
            }
        } else {
            throw $e;
        }
    }
}
