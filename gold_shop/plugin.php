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
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'Gold Shop';
$eplug_version = '1.2';
$eplug_author = 'Barry';
$eplug_url = 'http://www.keal.me.uk';
$eplug_email = '';
$eplug_description = GSHOP_P001;
$eplug_compatible = 'e107v7';
$eplug_readme = 'admin_readme.php';        // leave blank if no readme file
$eplug_compliant=true;
$eplug_status = TRUE;
$eplug_latest = TRUE;

// Name of the plugin"s folder -------------------------------------------------------------------------------------
$eplug_folder = 'gold_shop';


// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder.'/images/gshop_32.png';
$eplug_icon_small = $eplug_folder.'/images/gshop_16.png';
$eplug_caption =  GSHOP_P003;

// List of preferences -----------------------------------------------------------------------------------------------
// Handled in class
// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/gold_shop_sql.php");
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

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = GSHOP_P002;
$eplug_link_url = e_PLUGIN.'gold_shop/index.php';

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = GSHOP_P003;

// upgrading ... //

$upgrade_add_prefs = '';

$upgrade_remove_prefs = '';
$upgrade_alter_tables = '';
$eplug_upgrade_done = '';

// Deleting plugin ...//
if (!function_exists('gold_bookie_uninstall'))
{
    function gold_bookie_uninstall()
    {
        // get rid of the things we created
        global $sql;

        $sql->db_Delete('core', ' e107_name="gold_shop" ');
    }
}

?>