<?php
// get the language file for the plugin
// This can be used to make the links and descriptions etc language
// independent
include_lan(e_PLUGIN . "gold_settings/languages/" . e_LANGUAGE . ".php");
if (!is_object($gset_obj))
{
    require_once(e_PLUGIN . 'gold_settings/includes/gold_settings_class.php');
    $gset_obj = new gold_settings;
}
// Define an element in the array $e_gold
$e_gold[] = array('plug_name' => 'Gold Settings', // the name of this plugin - can be a language constant
    'plug_folder' => 'gold_settings', // the folder name for this plugin
    'add' => true, // Is gold added by this plugin
    'deduct' => true, // is gold deducted by this plugin
    'gold_menu' => true, // Does it have a link to go in the gold menu
    'gold_link' => '{e_PLUGIN}gold_settings/index.php', // the link for the gold menu to the main plugin file
    'gold_title' => GSET_SETTINGS_BUY, // The title for the plugin in the menu
    'gold_shop' => true, // Does this plugin integrate into the gold shop
    'gold_shop_title' => GSET_SETTINGS_TITLE, // title to appear in the gold shop
    'gold_shop_name' => GSET_SETTINGS_NAME, // The name to go in the gold shop
    'gold_shop_desc' => GSET_SETTINGS_DESC, // A full text description of the shop entry
    'gold_shop_icon' => e_PLUGIN . 'gold_settings/images/gold_settings_64.png', // the Icon for the shop (64 x 64px)
    'gold_shop_url' => e_PLUGIN . 'gold_settings/index.php', // the url to the main plugin
    'gold_centre_charge_title' => GSET_SETTINGS_G05,
    'gold_centre_charge_text' =>
    '<br />' . GSET_SETTINGS_G06 . ' ' . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_customtitle']) . '<br />' .  GSET_SETTINGS_G07 . ' ' . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_name']) . '<br />'  . GSET_SETTINGS_G08 . ' ' . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_signature']) . '<br />'  . GSET_SETTINGS_G09 . ' ' . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_avatar']) . '<br />',
    );

if (!function_exists('gold_settings_configure_edit'))
{
    // Function for setting any parameters for this plugin
    // this is displayed in the main gold system Plugins configuration
    // not essential to do this, just return a message saying to use the main config
    // for the plugin
    function gold_settings_configure_edit()
    {
        $retval = "
<form method='post' action='" . e_SELF . "' id='gold_present' >
	<div>
		<input type='hidden' name='gold_plugin' value='gold_present' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . GSET_SETTINGS_G01 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left'>" . GSET_SETTINGS_G02 . "&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left'>
				<input type='submit' class='button' name='gold_save' value='" . GSET_SETTINGS_G03 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>";
        // contents of $retval displayed in gold plugin manager
        return $retval;
    }
}
if (!function_exists('gold_settings_configure_save'))
{
    function gold_settings_configure_save()
    {
        // perform any saving of settings then return success fail message as appropriate.
        return GSET_SETTINGS_G04;
    }
}

?>