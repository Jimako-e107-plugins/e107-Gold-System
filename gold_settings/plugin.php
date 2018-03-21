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
include_lan(e_PLUGIN . 'gold_settings/languages/' . e_LANGUAGE . '.php');
$eplug_name = 'Gold Settings';
$eplug_version = '1.3';
$eplug_author = 'Father Barry';
$eplug_folder = 'gold_settings';
$eplug_icon = $eplug_folder . '/images/gold_settings_32.png';
$eplug_icon_small = $eplug_folder . '/images/gold_settings_16.png';
$eplug_url = 'www.e107gold.com';
$eplug_email = '';
$eplug_description = GSET_PM_02;
$eplug_compatible = 'e107v0.7.11+';
$eplug_compliant = true;
$eplug_conffile = 'admin_config.php';
$eplug_caption = GSET_PM_01;
$eplug_done = GSET_PM_03;
$eplug_upgrade_done = GSET_PM_04;

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = GSET_PM_05;
$eplug_link_url = e_PLUGIN.'gold_settings/index.php';

// prefs created in class
// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/gold_settings_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names = $matches[1];
// List of sql requests to create tables -----------------------------------------------------------------------------
// Apply create instructions for every table you defined in locator_sql.php --------------------------------------
// MPREFIX must be used because database prefix can be customized instead of default e107_
$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE ' . MPREFIX, $eplug_sql));
for ($i = 0; $i < count($eplug_tables); $i++)
{
    $eplug_tables[$i] .= ';';
}
array_pop($eplug_tables); // Get rid of last (empty) entry
// Deleting plugin ...//
if (!function_exists('gold_settings_uninstall'))
{
    function gold_settings_uninstall()
    {
        // get rid of the things we created
        global $sql;
        $sql->db_Delete('core', ' e107_name="gold_settings" ');
    }
}

?>