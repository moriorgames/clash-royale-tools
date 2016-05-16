<?php

namespace AppBundle\Command;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * Class BaseQueueCommand
 * @package QueueBundle\Console
 */
class BaseCommand extends ContainerAwareCommand
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * Command constructor.
     *
     * @param string      $commandName
     * @param ContainerBuilder $container
     */
    public function __construct($commandName, ContainerBuilder $container)
    {
        parent::__construct($commandName);
        $this->container = $container;
    }
}
