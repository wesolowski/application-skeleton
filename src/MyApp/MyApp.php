<?php

namespace MyApp;

use Symfony\Component\DependencyInjection\ContainerInterface;

class MyApp
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}