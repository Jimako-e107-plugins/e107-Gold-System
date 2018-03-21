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
include_lan(e_PLUGIN . 'gold_system/languages/admin/' . e_LANGUAGE . '.php');
$eplug_name = 'Gold Classes';
$eplug_version = "1.1.1";
$eplug_author = "Father Barry";
$eplug_folder = "gold_classes";
$eplug_icon = $eplug_folder . '/images/goldclass_32.png';
$eplug_icon_small = $eplug_folder . '/images/goldclass_32.png';
$eplug_url = 'www.keal.me.uk';
$eplug_email = '';
$eplug_description = ADLAN_GS_PM_02;
$eplug_compatible = 'e107v0.7.11+';
$eplug_compliant = true;
$eplug_menu_name = '';
$eplug_conffile = 'admin_config.php';
$eplug_caption = ADLAN_GS_PM_01;

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = GLOTTO_P01;
$eplug_link_url = e_PLUGIN.'gold_classes/index.php';

$eplug_done = ADLAN_GS_PM_03;
$eplug_upgrade_done = ADLAN_GS_PM_04;
// prefs created in class
// it doesn't actually need this but its there to fool e107 into thinking it is installed.
$eplug_prefs = array("gold_classes"=>0
    );
#// create tables -----------------------------------------------------------------------------------------------
#$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/gold_system_sql.php");
#preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
#$eplug_table_names = $matches[1];
#// List of sql requests to create tables -----------------------------------------------------------------------------
#// Apply create instructions for every table you defined in locator_sql.php --------------------------------------
#// MPREFIX must be used because database prefix can be customized instead of default e107_
#$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE ' . MPREFIX, $eplug_sql));
#for ($i = 0; $i < count($eplug_tables); $i++)
#{
#    $eplug_tables[$i] .= ';';
#}
#array_pop($eplug_tables); // Get rid of last (empty) entry

// Deleting plugin ...//
if (!function_exists('gold_classes_uninstall'))
{
    function gold_classes_uninstall()
    {
        // get rid of the things we created
        global $sql;
        // $sql->db_Delete("rate", " rate_table='gold' ");
        // $sql->db_Delete("comments", " comment_type='gold' ");
        $sql->db_Delete('core', ' e107_name="gold_class" ');
    }
}

?>