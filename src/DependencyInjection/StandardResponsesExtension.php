<?php

declare(strict_types = 1);

namespace stereoflo\responder\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class StandardResponsesExtension extends Extension
{
    private const CONFIG_PATH     = __DIR__ . '/../Resources/config';
    private const CONFIG_FILENAME = 'services.yaml';

    /**
     * @param array<string, mixed> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(self::CONFIG_PATH));
        $loader->load(self::CONFIG_FILENAME);
    }
}
