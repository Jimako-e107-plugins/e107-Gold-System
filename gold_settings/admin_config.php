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
include_lan(e_PLUGIN . 'gold_settings/languages/' . e_LANGUAGE . '.php');

if (!is_object($gset_obj))
{
    require_once(e_PLUGIN . 'gold_settings/includes/gold_settings_class.php');
    $gset_obj = new gold_settings;
}
if (isset($_POST['updatesettings']))
{
    $GOLD_SETTINGS_PREF['gset_color'] = $tp->toDB($_POST['gset_color']);
    $GOLD_SETTINGS_PREF['gset_customtitle'] = $tp->toDB($_POST['gset_customtitle']);
    $GOLD_SETTINGS_PREF['gset_name'] = $tp->toDB($_POST['gset_name']);
    $GOLD_SETTINGS_PREF['gset_signature'] = $tp->toDB($_POST['gset_signature']);
    $GOLD_SETTINGS_PREF['gset_avatar'] = $tp->toDB($_POST['gset_avatar']);
    $gset_obj->save_prefs();

    if (!is_numeric($GOLD_SETTINGS_PREF['gset_name']))
    {
        $gold_msg = GSET_GS_S12;
    } elseif (!is_numeric($GOLD_SETTINGS_PREF['gset_signature']))
    {
        $gold_msg = GSET_GS_S03;
    } elseif (!is_numeric($GOLD_SETTINGS_PREF['gset_avatar']))
    {
        $gold_msg = GSET_GS_S01;
    }
    else
    {
        $gold_msg = GSET_GS_S10;
    }
}

$gold_text = '
	<form method="post" action="' . e_SELF . '" id="gold_form" >
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
		<td class="fcaption" colspan="2" style="text-align:left">' . GSET_GS_S09 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
	</tr>';
// $gold_text .= '
// <tr>
// <td class="forumheader3" style="width:30%">' . GSET_GS_S04 . '</td>
// <td class="forumheader3" style="width:70%">
// <input type="text" class="tbox" name="gset_color" value="' . $tp->toFORM($GOLD_SETTINGS_PREF['gset_color']) . '" />
// </td>
// </tr>';
$gold_text .= '
	<tr>
		<td class="forumheader3" style="width:30%">' . GSET_GS_S05 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gset_customtitle" value="' . $tp->toFORM($GOLD_SETTINGS_PREF['gset_customtitle']) . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . GSET_GS_S06 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gset_name" value="' . $tp->toFORM($GOLD_SETTINGS_PREF['gset_name']) . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . GSET_GS_S07 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gset_signature" value="' . $tp->toFORM($GOLD_SETTINGS_PREF['gset_signature']) . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . GSET_GS_S08 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gset_avatar" value="' . $tp->toFORM($GOLD_SETTINGS_PREF['gset_avatar']) . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left">
			<input type="submit" class="button" name="updatesettings" value="' . GSET_GS_S14 . '" />
		</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';

$ns->tablerender(GSET_GS_S13, $gold_text);
require_once(e_ADMIN . 'footer.php');

?>