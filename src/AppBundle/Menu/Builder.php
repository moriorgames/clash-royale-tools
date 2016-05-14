<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;


/**
 * Class Builder.
 */
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('menu.homepage', ['route' => 'calculate']);
        $menu->addChild('menu.crud.list', ['route' => 'crud_list']);

        return $menu;
    }
}
