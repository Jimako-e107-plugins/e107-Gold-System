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
// get the language file
include_lan(e_PLUGIN . 'gold_classes/languages/' . e_LANGUAGE . '.php');
$e_gold[] = array('plug_name' => 'Gold Classes', 'plug_folder' => 'gold_classes', 'add' => false, 'deduct' => true, 'gold_menu' => true, 'gold_link' => '{e_PLUGIN}.gold_classes/index.php', 'gold_title' => 'By User Classes');

if (!function_exists('gold_classes_configure_edit'))
{
    function gold_classes_configure_edit()
    {
    }
}
if (!function_exists("gold_classes_configure_save"))
{
    function gold_classes_configure_save()
    {
    }
}

?>