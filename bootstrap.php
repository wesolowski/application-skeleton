<?php

require_once __DIR__ .'/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Finder\Finder;

$nxsAppPath = __DIR__ . '/src/MyApp';

$container = new ContainerBuilder();
$loader = new XmlFileLoader(
    $container,
    new FileLocator($nxsAppPath)
);
$loader->load('services.xml');

// Load Domain services.xml
$finder = new Finder();
$finder->files();
$finder->in($nxsAppPath . '/Domain/*/');
$finder->name('services.xml');

foreach ($finder as $file) {
    $loader->load($file->getRealPath());
}

$container->addCompilerPass(new \Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass());
$container->compile();

// Create global Function

/**
 * @param \MyApp\App|null $newApp
 * @return \MyApp\MyApp
 */
function MyApp(\MyApp\App $newApp = null)
{
    static $app;
    if (isset($newApp)) {
        $app = $newApp;
    } elseif (!isset($app)) {
        throw new RuntimeException("App not booted");
    }
    return $app;
}

$myApp = new \MyApp\MyApp($container);
MyApp($myApp);