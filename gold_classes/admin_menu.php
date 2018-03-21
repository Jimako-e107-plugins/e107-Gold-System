<?php
/*
+---------------------------------------------------------------+
|        Gold Classes for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'gold_classes/languages/admin/' . e_LANGUAGE . '.php');

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = ADLAN_GS_MM01;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_readme']['text'] = ADLAN_GS_MM90;
$var['admin_readme']['link'] = 'admin_readme.php';

$var['admin_vupdate']['text'] = ADLAN_GS_MM91;
$var['admin_vupdate']['link'] = 'admin_vupdate.php';

show_admin_menu(ADLAN_GS_MM92, $action, $var);

?>