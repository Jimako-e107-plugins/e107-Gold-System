<?php
/*
+---------------------------------------------------------------+
|        Gold Download for e107 v7xx - by Father Barry
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
$eplug_name = 'Gold Download';
$eplug_version = '1.1';
$eplug_author = 'Father Barry';
$eplug_folder = 'gold_download';
$eplug_icon = $eplug_folder . '/images/gold_dl_32.png';
$eplug_icon_small = $eplug_folder . '/images/gold_dl_16.png';
$eplug_url = 'www.e107gold.com';
$eplug_email = '';
$eplug_description = GOLD_DL_P01;
$eplug_compatible = 'e107v0.7.11+';
$eplug_compliant = true;
$eplug_menu_name = '';
$eplug_conffile = 'admin_config.php';
$eplug_caption = GOLD_DL_P04;
$eplug_done = GOLD_DL_P02;
$eplug_upgrade_done = GOLD_DL_P03;
// prefs created in class
/*
// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/gold_system_sql.php");
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
*/
// it doesn't actually need this but its there to fool e107 into thinking it is installed.
$eplug_prefs = array("gold_download"=>0
    );
$upgrade_alter_tables = '';
// Deleting plugin ...//
if (!function_exists('gold_download_uninstall'))
{
    function gold_download_uninstall()
    {
        // get rid of the things we created
        global $sql;
        $sql->db_Delete('core', ' e107_name="plugin_gold_download" ');
    }
}

?>