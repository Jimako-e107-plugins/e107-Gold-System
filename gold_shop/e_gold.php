<?php

// get the language file for the plugin
include_lan(e_PLUGIN . "gold_shop/languages/" . e_LANGUAGE . "_gold_shop.php");
$e_gold[] = array('plug_name' => 'Gold Shop',
    'plug_folder' => 'gold_shop',
    'add' => true,
    'deduct' => true,
    'gold_menu' => true,
    'gold_link' => '{e_PLUGIN}gold_shop/index.php',
    'gold_menu' => true, // Does it have a link to go in the gold menu
    'gold_title' => GOLD_SHOP_G01, // The title for the plugin in the menu
    'gold_shop' => true, // Does this plugin integrate into the gold shop
    'gold_shop_title' => GOLD_SHOP_G01, // title to appear in the gold shop
    'gold_shop_name' => GOLD_SHOP_G02, // The name to go in the gold shop
    'gold_shop_desc' => GOLD_SHOP_G03, // A full text description of the shop entry
    'gold_shop_icon' => e_PLUGIN . 'gold_shop/images/gshop_64.png', // the Icon for the shop (64 x 64px)
    'gold_shop_url' => e_PLUGIN . 'gold_shop/index.php'); // the url to the main plugin);

if (!function_exists('gold_shop_configure_edit'))
{
    function gold_shop_configure_edit()
    {
        // get globals in case already set

        $retval = "
<form method='post' action='" . e_SELF . "' id='gold_shop' >
<div>
	<input type='hidden' name='gold_plugin' value='gold_shop' />
</div>
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>" . GOLD_SHOP_G07 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'>" . GOLD_SHOP_G04 . "&nbsp;</td>
	</tr>

	<tr>
		<td class='forumheader2' colspan='2' style='text-align:left'>
			<input type='submit' class='button' name='gold_save' value='" . GOLD_SHOP_G05 . "'</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>&nbsp;</td>
	</tr>
</table>
</form>
";
        return $retval;
    }
}
if (!function_exists('gold_shop_configure_save'))
{
    function gold_shop_configure_save()
    {
        // get globals in case already set

        return GOLD_SHOP_G06;
    }
}

?>