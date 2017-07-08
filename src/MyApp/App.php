<?php

namespace MyApp;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface App
{
    /**
     * @return ContainerInterface
     */
    public function getContainer();
}