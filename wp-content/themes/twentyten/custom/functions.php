<?php
$separateur     = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$path           = str_replace($separateur, '', $_SERVER['REQUEST_URI']);
$slugs          = explode('/', $path);



if(count($slugs) == 1 && $slugs['0']=='ffcommunity'){
    require_once 'ffcommunity.php';
}
