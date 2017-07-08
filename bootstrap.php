<?php

require_once __DIR__ .'/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Finder\Finder;

$nxsAppPath = __DIR__ . '/src/NxsApp';

$container = new ContainerBuilder();
$loader = new XmlFileLoader(
    $container,
    new FileLocator($nxsAppPath)
);
$loader->load('services.xml');

$finder = new Finder();
$finder->files();
$finder->in($nxsAppPath . '/Domain/*/');
$finder->name('services.xml');

foreach ($finder as $file) {
    $loader->load($file->getRealPath());
}
die(PHP_EOL . '<br>die: ' . __FUNCTION__ .' / '. __FILE__ .' / '. __LINE__);
