<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');

        $authorizationChecker = $this->container->get('security.authorization_checker');

        $menu->addChild('На главную', ['route' => 'app_index']);
        if ($authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $rss = $menu->addChild('RSS');
//            $rss->addChild('Добавить RSS', ['route' => 'app_feed_new']);
//            $rss->addChild('Упраление RSS', ['route' => 'app_feed_edit']);
//            $rss->addChild('Импорт OPML', ['route' => 'app_import_opml']);
        }
        if ($authorizationChecker->isGranted('ROLE_ADMIN')) {
//            $admin = $menu->addChild('Администрирование');
//            $admin->addChild('Статистика', ['route' => 'admin_stat']);
        }

        return $menu;
    }
}
