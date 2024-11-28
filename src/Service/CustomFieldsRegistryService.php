<?php

namespace WonderWp\Component\CustomFields\Service;

use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\PluginSkeleton\ManagerAwareTrait;
use WonderWp\Component\PluginSkeleton\Service\RegistrableInterface;

class CustomFieldsRegistryService extends AbstractTaxonomyService implements RegistrableInterface, ManagerAwareInterface
{
    use ManagerAwareTrait;

    public function register()
    {
        add_action('init', function(){
            $autoLoaded = $this->autoload();
        },9);
    }

    public function autoload(array $classNameFromFiles = [], array $discoveryPaths = [], callable $successCallback = null): array
    {
        $defaultPaths = [
            'custom-fields' => $this->manager->getConfig('path.root') . 'includes' . DIRECTORY_SEPARATOR . 'CustomFields',
        ];
        $discoveryPaths = array_merge($defaultPaths, $discoveryPaths);
        $autoLoaded = parent::autoload($classNameFromFiles, $discoveryPaths, $successCallback);
        dump($autoLoaded);

        return $autoLoaded;
    }


}
