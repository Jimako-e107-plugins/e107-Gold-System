<?php
/*
+---------------------------------------------------------------+
|        Gold Downloads for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'gold_download/languages/' . e_LANGUAGE . '.php');

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = GOLD_DL_M01;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_readme']['text'] = GOLD_DL_M02;
$var['admin_readme']['link'] = 'admin_readme.php';

$var['admin_vupdate']['text'] = GOLD_DL_M03;
$var['admin_vupdate']['link'] = 'admin_vupdate.php';

show_admin_menu(GOLD_DL_M04, $action, $var);
?>