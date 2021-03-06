<?php

    require (SYSTEM_PATH . 'core/common.php');

    $config =& loadClass('Config', 'Core');
    $log =& loadClass('Log', 'Core');
    $vendor =& loadClass('Vendor', 'Core');

    $input =& loadClass('Input', 'Core');
    $uri =& loadClass('URI', 'Core');

    $hook =& loadClass('Hook', 'Core');
    $loader =& loadClass('Loader', 'Core');
    $router =& loadClass('Router', 'Core');

    $db =& loadClass('DB', 'db');

    $page =& loadClass('Page', 'Core');
    $curPage =& $page->getInstance();
    $method = $router->method;

    $loader->autoload();
    $curPage->$method();
?>
