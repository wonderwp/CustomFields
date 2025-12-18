<?php

namespace WonderWp\Component\CustomFields\Service;

use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\PluginSkeleton\ManagerAwareTrait;
use WonderWp\Component\PluginSkeleton\Service\RegistrableInterface;

class CustomFieldsRegistryService extends AbstractCustomFieldsRegistryService implements RegistrableInterface, ManagerAwareInterface
{
    use ManagerAwareTrait;

    public function register()
    {
        add_action('init', function () {
            $autoLoaded = $this->autoload();
        }, 9);
    }


}
