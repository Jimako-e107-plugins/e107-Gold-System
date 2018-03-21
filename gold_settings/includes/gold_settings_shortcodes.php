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
include_once(e_HANDLER . 'shortcode_handler.php');
$gold_settings_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*

SC_BEGIN GOLD_MESSAGE
global $gold_message;
return $gold_message;
SC_END


SC_BEGIN GOLD_BUY_MYBALANCE
global $gold_obj, $gold_mybalance;
return $gold_obj->formation($gold_mybalance);
SC_END

SC_BEGIN GOLD_BUY_AVATAR_IMAGE
global $tp,$gold_userimage;
return '<input class="tbox" type="text" name="avatar" size="60" onKeyDown=\'avatar_remote();\' value="'.$tp->toFORM($gold_userimage).'"/>';
SC_END


SC_BEGIN GOLD_SHOP_CUSTOMTITLE
global $GOLD_SETTINGS_PREF, $gold_obj;
return "<a href='index.php?buy=custom_title' style='text-decoration: none'  onclick=\"return gold_ConfirmPurchase('" . GSET_GS_S05 . "'," . $GOLD_SETTINGS_PREF['gset_customtitle'] . ")\">" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_customtitle']) . "</a>";
SC_END

SC_BEGIN GOLD_SHOP_DISPLAY
global $GOLD_SETTINGS_PREF, $gold_obj;
return "<a href='index.php?buy=display_name' style='text-decoration: none' onclick=\"return gold_ConfirmPurchase('" . GSET_GS_S04 . "'," . $GOLD_SETTINGS_PREF['gset_name'] . ")\">" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_name']) . "</a>";
SC_END

SC_BEGIN GOLD_SHOP_SIGNATURE
global $GOLD_SETTINGS_PREF, $gold_obj;
return "<a href='index.php?buy=signature' style='text-decoration: none' onclick=\"return gold_ConfirmPurchase('" . GSET_GS_S07 . "'," . $GOLD_SETTINGS_PREF['gset_signature'] . ")\">" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_signature']) . "</a>";
SC_END

SC_BEGIN GOLD_SHOP_AVATAR
global $GOLD_SETTINGS_PREF, $gold_obj;
return "<a href='index.php?buy=avatar' style='text-decoration: none' onclick=\"return gold_ConfirmPurchase('" . GSET_GS_S08 . "'," . $GOLD_SETTINGS_PREF['gset_avatar'] . ")\" >" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_avatar']) . "</a>";
SC_END

SC_BEGIN GOLD_SHOP_MESSAGE
global $message;
return $message;
SC_END

SC_BEGIN GOLD_SHOP_BALANCE
global $gold_mybalance, $gold_obj;
return $gold_obj->formation($gold_mybalance);
SC_END

SC_BEGIN GOLD_BUY_TITLE_BUTTON
global $GOLD_SETTINGS_PREF;
return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S05 . "'," . $GOLD_SETTINGS_PREF['gset_customtitle'] . ",'custom_title')\" value='" . GSET_GS_S16 . "' />";
SC_END

SC_BEGIN GOLD_BUY_NAME_BUTTON
global $GOLD_SETTINGS_PREF;
return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S04 . "'," . $GOLD_SETTINGS_PREF['gset_name'] . ",'display_name')\" value='" . GSET_GS_S16 . "'>";
SC_END

SC_BEGIN GOLD_BUY_SIGNATURE_BUTTON
global $GOLD_SETTINGS_PREF;
return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S07 . "'," . $GOLD_SETTINGS_PREF['gset_signature'] . ",'signature')\" value='" . GSET_GS_S16 . "'>";
SC_END

SC_BEGIN GOLD_BUY_AVATAR_BUTTON
global $GOLD_SETTINGS_PREF;
return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S08 . "'," . $GOLD_SETTINGS_PREF['gset_avatar'] . ",'avatar')\" value='" . GSET_GS_S16 . "'>";
SC_END

SC_BEGIN GOLD_BUY_TITLE
global $display;
return '<input class="tbox" type="text" name="customtitle" value="'.$display.'" />';
SC_END

SC_BEGIN GOLD_BUY_SUBMIT
return "<input class='button' type='submit' name='update' value='" . GSET_GS_S16 . "' />";
SC_END

SC_BEGIN GOLD_BUY_DISPLAYNAME
global $display, $pref;
return '<input class="tbox" type="text" name="display_name" maxlength="'.$pref['displayname_maxlength'].'" value="'.$display.'" />';
SC_END

SC_BEGIN GOLD_BUY_SIGPREVIEW
global $tp;
return $tp->toHTML($_POST['signature'], true);
SC_END

SC_BEGIN GOLD_BUY_SIGNATURE
global $display;

return "<textarea class='tbox signature' name='signature' cols='58' style='width:80%' rows='4' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>{$display}</textarea>
<input id='goldhelp' class='helpbox' type='text' name='goldhelp' size='100' style='width:80%'/>
			<br />" . display_help("goldhelp");;
SC_END

SC_BEGIN GOLD_BUY_PREVIEW

return "<input class='button' name='preview' type='submit' value='" . GSET_GS_S17 . "' />";
SC_END

SC_BEGIN GOLD_BUY_SITEAVATAR
global $ret;
return $ret;
SC_END

SC_BEGIN GOLD_BUY_RESET

return "<input class='button' type='reset' name='reset' value='" . GSET_GS_S18 . "' />";
SC_END

SC_BEGIN GOLD_BUY_AVATAR_UPLOAD
global $upload;
return "<input class='tbox' id='upload' {$upload} name='file_userfile[]' type='file' size='47' onchange=\"avatar_upload();\" />";
SC_END

SC_BEGIN GOLD_BUY_AVATAR_STATUS
global $upload_value;
return $upload_value;
SC_END

SC_BEGIN GOLD_BUY_UPDIR
global $gset_fromuser;
if($gset_fromuser)
{
	return '<a href="'.SITEURL.'usersettings.php" ><img src="./images/updir.png" style="border:0px;" alt="'.GSET_GS_S34.'" title="'.GSET_GS_S34.'" /></a>';
}
else
{
	return '<a href="'.e_SELF.'" ><img src="./images/updir.png" style="border:0px;" alt="'.GSET_GS_S34.'" title="'.GSET_GS_S34.'" /></a>';
}
SC_END

*/