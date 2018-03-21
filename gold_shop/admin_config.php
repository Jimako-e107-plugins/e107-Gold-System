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
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . "gold_shop/languages/" . e_LANGUAGE . "_gold_shop.php");
if (!is_object($gshop_obj))
{
    require_once(e_PLUGIN . 'gold_shop/includes/gold_shop_class.php');
    $gshop_obj = new gold_shop;
}
#if (e_QUERY)
#{
#    $gold_tmp = explode('.', e_QUERY);
#    $gold_action = $gold_tmp[0];
#    $gold_plugin = $gold_tmp[1];
#} elseif (isset($_POST['gold_save']))
#{
#    $gold_action = 'gold_save';
#    $gold_plugin = $_POST['gold_plugin'];
#}
#if (!empty($gold_plugin))
#{
#    require_once(e_PLUGIN . $gold_plugin . '/e_gold.php');
#    if ($gold_action == 'gold_edit')
#    {
#        $tmp = $gold_plugin . '_configure_edit';
#        if (function_exists($tmp))
#        {
#            $gold_text = $tmp();
#        }
#    }
#    if ($gold_action == 'gold_save')
#    {
#        $tmp = $gold_plugin . '_configure_save';
#
#        if (function_exists($tmp))
#        {
#            $gold_msg = $tmp();
#            $gold_action = '';
#        }
#    }
#}
// *****************************************************************************************************
// *
// *	Update the main list of gold shop enabled plugins
// *
// *****************************************************************************************************
if (isset($_POST['updatesettings']))
{
    $GOLD_SHOP_PREF['gold_shop_show'] = ($_POST['gold_shop_show']);
    $gshop_obj->save_prefs();
    $gold_msg = GOLD_SHOP_MP11;
}
// print_a($_POST);
// *****************************************************************************************************
// *
// *	Display list of plugins that are installed which have e_gold.php
// *
// *****************************************************************************************************
if ($gold_action == '')
{
    $gold_pluglist = $pref['plug_installed'];
    ksort($gold_pluglist);
    // print_a($GOLD_SHOP_PREF['gold_menushow']);
    foreach($gold_pluglist as $gold_plugin => $gold_version)
    {
        if (file_exists(e_PLUGIN . $gold_plugin . '/e_gold.php') && is_readable(e_PLUGIN . $gold_plugin . '/e_gold.php'))
        {
            require_once(e_PLUGIN . $gold_plugin . '/e_gold.php');
        }
    }

    $gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_plugins" >
<table class="fborder" style="' . ADMIN_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="4" style="text-align:left">' . GOLD_SHOP_MP01 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="4" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader2" style="width:15%;text-align:left"><b>' . GOLD_SHOP_MP02 . '</b></td>
		<td class="forumheader2" style="width:15%;text-align:left"><b>' . GOLD_SHOP_MP19 . '</b></td>
		<td class="forumheader2" style="width:60%;text-align:left"><b>' . GOLD_SHOP_MP20 . '</b></td>
		<td class="forumheader2" style="width:10%;text-align:center"><b>' . GOLD_SHOP_MP10 . '</b></td>

	</tr>';
  //  print_a($e_gold);
    foreach($e_gold as $key)
    {
        if ($key['gold_shop'])
        {
            $gold_text .= '
	<tr>
		<td class="forumheader3" style="text-align:left">' . $key['plug_name'] . '</td>';
            // there is a page to link to for the plugin
            $gold_text .= "
		<td class='forumheader3' style='text-align:left'>".$key['gold_shop_name'] . " </td>
		<td class='forumheader3' style='text-align:left'>".$key['gold_shop_desc'] . " </td>";
            $gold_text .= '
		<td class="forumheader3" style="text-align:center">
			<input type="checkbox" class="tbox" name="gold_shop_show[' . $key['plug_folder'] . ']" value="'.$key['plug_folder'].'" ' . ($GOLD_SHOP_PREF['gold_shop_show'][$key['plug_folder']] ==$key['plug_folder'] ? 'checked="checked"':'') . '/>
		</td>

	</tr>';
        }
    }
    $gold_text .= '
	<tr>
		<td class="forumheader2" colspan="4" style="text-align:left">
			<input type="submit" class="button" name="updatesettings" value="' . GOLD_SHOP_MP12 . '" />
		</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="4" style="text-align:left">&nbsp;</td>
	</tr>
</table>
</form>';
}
$ns->tablerender(GOLD_SHOP_03, $gold_text);
require_once(e_ADMIN . 'footer.php');
