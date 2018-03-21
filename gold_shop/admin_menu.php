<?php
/*
+---------------------------------------------------------------+
|        Gold Shop for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "gold_shop/languages/" . e_LANGUAGE . "_gold_shop.php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = GOLD_SHOP_M_02;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_readme']['text'] = GOLD_SHOP_M_04;
$var['admin_readme']['link'] = 'admin_readme.php';

$var['admin_vupdate']['text'] = GOLD_SHOP_M_05;
$var['admin_vupdate']['link'] = 'admin_vupdate.php';

show_admin_menu(GOLD_SHOP_M_01, $action, $var);

?>
