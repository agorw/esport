<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;

class Builder
{
    /**
     * Objet pour construire un menu.
     */
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Créer le menu principal
     *
     * @param array $options
     *
     * @return \Knp\Menu\ItemInterface The complete menu.
     */
    public function mainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes'    => array(
                'class'                 => 'page-sidebar-menu',
                'data-keep-expanded'    => 'false',
                'data-auto-scroll'      => 'false',
                'data-slide-speed'      => '100',
            ),
        ));

        $menu->addChild('Home', ['route' => 'app\index.html.twig']);

        return $menu;
    }
}
