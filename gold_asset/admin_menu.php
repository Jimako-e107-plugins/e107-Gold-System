<?php
/*
+---------------------------------------------------------------+
|        Gold Asset for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

include_lan(e_PLUGIN . "gold_asset/languages/" . e_LANGUAGE . "_goldasset.php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = GOLD_ASSET_M_02;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_asset']['text'] = GOLD_ASSET_M_03;
$var['admin_asset']['link'] = 'admin_asset.php';
/*
$var['admin_cat']['text'] = GOLD_ASSET_M_06;
$var['admin_cat']['link'] = 'admin_cat.php';
*/
$var['admin_category']['text'] = GOLD_ASSET_M_06;
$var['admin_category']['link'] = 'admin_category.php';
$var['admin_category']['perm'] = 'P';


$var['admin_newcategory']['text'] = LAN_CREATE . " " .GOLD_ASSET_O_06;
$var['admin_newcategory']['link'] = 'admin_category.php?mode=main&action=create';
$var['admin_newcategory']['perm'] = 'P';

$var['admin_readme']['text'] = GOLD_ASSET_M_04;
$var['admin_readme']['link'] = 'admin_readme.php';
 

e107::getNav()->admin(GOLD_ASSET_M_01, $action, $var);

