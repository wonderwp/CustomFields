<?php

namespace WonderWp\Component\Customfields\Service;

use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\PluginSkeleton\ManagerAwareTrait;
use WonderWp\Component\PluginSkeleton\Service\RegistrableInterface;

class FieldsRegistryService extends AbstractTaxonomyService implements RegistrableInterface, ManagerAwareInterface
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
            'taxonomies' => $this->manager->getConfig('path.root') . 'includes' . DIRECTORY_SEPARATOR . 'Taxonomies',
        ];
        $discoveryPaths = array_merge($defaultPaths, $discoveryPaths);
        $autoLoaded = parent::autoload($classNameFromFiles, $discoveryPaths, $successCallback);

        if (!empty($this->taxonomies)) {
            $this->registerTaxonomies();
        }

        return $autoLoaded;
    }

    protected function autoloadFile(string $className, string $filePath): object
    {
        $instance = parent::autoloadFile($className, $filePath);

        $this->addTaxonomy($instance);

        return $instance;
    }


}
