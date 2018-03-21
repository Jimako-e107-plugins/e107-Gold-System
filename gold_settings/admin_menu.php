<?php
/*
+---------------------------------------------------------------+
|        Gold Settings for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . 'gold_system/languages/admin/' . e_LANGUAGE . '.php');

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = GSET_GS_MM02;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_readme']['text'] = GSET_GS_MM03;
$var['admin_readme']['link'] = 'admin_readme.php';

$var['admin_vupdate']['text'] = GSET_GS_MM04;
$var['admin_vupdate']['link'] = 'admin_vupdate.php';

show_admin_menu(GSET_GS_MM01, $action, $var);

?>