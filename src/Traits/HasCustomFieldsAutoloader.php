<?php

namespace WonderWp\Component\CustomFields\Traits;

trait HasCustomFieldsAutoloader
{
    /**
     * Customize discovery paths for custom fields registries.
     *
     * @param array $discoveryPaths
     * @return array
     */
    protected function resolveDiscoveryPaths(array $discoveryPaths): array
    {
        $discoveryPathsRoots = $this->manager->getConfig('discoveryPathsRoots', [
            'custom-fields' => rtrim($this->manager->getConfig('path.root') ?? '', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR,
        ]);

        $discoverFolderSuffix = $this->manager->getConfig('cptservice.discoverFolderSuffix', 'CustomFields');
        $defaultPaths         = $this->deductDefaultDiscoveryPaths($discoveryPathsRoots, $discoverFolderSuffix);

        return array_merge($defaultPaths, $discoveryPaths);
    }
}


