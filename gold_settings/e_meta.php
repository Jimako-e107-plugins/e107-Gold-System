<?php
include_lan(e_PLUGIN . 'gold_settings/languages/' . e_LANGUAGE . '.php');
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '.php');
global $GOLD_SETTINGS_PREF, $gset_obj;
if (!is_object($gset_obj))
{
    require_once(e_PLUGIN . 'gold_settings/includes/gold_settings_class.php');
    $gset_obj = new gold_settings;
}

echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_settings/includes/gold_settings.js"></script>';
echo '<script type="text/javascript">
var gold_settings_confirm_pre="' . GSET_GS_S32 . '"
var gold_settings_confirm_post="' . GSET_GS_S33 . '"
</script>';

// if (e_PAGE == 'usersettings.php' && (!is_numeric(e_QUERY) || e_QUERY == USERID || e_QUERY == ''))
if (!check_class($GOLD_PREF['gold_exempt_usersettings']) && (e_PAGE == 'usersettings.php' || e_PAGE == 'usersettingshandler.php' && (!is_numeric(e_QUERY) || e_QUERY == USERID || e_QUERY == '')))
{
    $qry = "SELECT u.*, ue.* FROM #user AS u
	LEFT JOIN #user_extended AS ue ON ue.user_extended_id = u.user_id
	WHERE u.user_id='" . intval(USERID) . "'";
    $sql->db_Select_gen($qry, false);
    $curVal = $sql->db_Fetch();
    $usersettings_custom_title_old = "{CUSTOMTITLE}";
    $usersettings_custom_title_new = "
	<tr>
		<td style='width:40%' class='forumheader3'>" . GSET_GS_S36 . ":</td>
		<td style='width:60%' class='forumheader2'>{$curVal['user_customtitle']} <input type='hidden' name='customtitle' value='{$curVal['user_customtitle']}'> - ".GSET_GS_S35."
			<a href='" . e_PLUGIN . "gold_settings/index.php?buy=custom_title' style='text-decoration: none' onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S05 . "'," . $GOLD_SETTINGS_PREF['gset_customtitle'] . ",'custom_title')\">" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_customtitle']) . "</a>
		</td>
	</tr>";
    $usersettings_display_name_old = "{USERNAME}";
    // *
    // $dis_name_len = varset($pref['displayname_maxlength'],15);
    // return $rs->form_text("username", $dis_name_len, $curVal['user_name'], $dis_name_len, "tbox");
    // *
    $usersettings_display_name_new = "<input type='hidden' name='username' value='{$curVal['user_name']}'>{$curVal['user_name']} - ".GSET_GS_S35." <a href='" . e_PLUGIN . "gold_settings/index.php?buy=display_name' style='text-decoration: none' onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S04 . "'," . $GOLD_SETTINGS_PREF['gset_name'] . ",'display_name')\" >" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_name']) . "</a>";
    $detect1 = strpos($USERSETTINGS_EDIT, "{SIGNATURE=cols=58&rows=4}");
    $detect2 = strpos($USERSETTINGS_EDIT, "{SIGNATURE_HELP}") + 16;
    $detect = $detect2 - $detect1;
    $usersettings_signature_old = substr($USERSETTINGS_EDIT, $detect1, $detect);
    $usersettings_signature_new = "<input type='hidden' name='signature' value='{$curVal['user_signature']}'>{$curVal['user_signature']} - ".GSET_GS_S35."
	<a href='" . e_PLUGIN . "gold_settings/index.php?buy=signature' style='text-decoration: none' onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S07 . "'," . $GOLD_SETTINGS_PREF['gset_signature'] . ",'signature')\">" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_signature']) . "</a>";
    $usersettings_avatar_old1 = "{AVATAR_REMOTE}";
    $usersettings_avatar_old2 = "{AVATAR_CHOOSE}";
    $usersettings_avatar_old3 = "{AVATAR_UPLOAD}";
    $usersettings_avatar_new = "<input type='hidden' name='image' value='{$curVal['user_image']}'>".GSET_GS_S35."
	<a href='" . e_PLUGIN . "gold_settings/index.php?buy=avatar' style='text-decoration: none' onclick=\"return gold_ConfirmPurchaseGo('" . GSET_GS_S08 . "'," . $GOLD_SETTINGS_PREF['gset_avatar'] . ",'avatar')\" >" . $gold_obj->formation($GOLD_SETTINGS_PREF['gset_avatar']) . "</a>";
    $USERSETTINGS_EDIT = str_replace($usersettings_custom_title_old, $usersettings_custom_title_new, $USERSETTINGS_EDIT);
    // query this bits purpose
    $USERSETTINGS_EDIT = str_replace($usersettings_display_name_old, $usersettings_display_name_new, $USERSETTINGS_EDIT);
    // *
    $USERSETTINGS_EDIT = str_replace($usersettings_signature_old, $usersettings_signature_new, $USERSETTINGS_EDIT);
    $USERSETTINGS_EDIT = str_replace($usersettings_avatar_old1, $usersettings_avatar_new, $USERSETTINGS_EDIT);
    $USERSETTINGS_EDIT = str_replace($usersettings_avatar_old2, $usersettings_avatar_new, $USERSETTINGS_EDIT);
    $USERSETTINGS_EDIT = str_replace($usersettings_avatar_old3, $usersettings_avatar_upload, $USERSETTINGS_EDIT);
}

?>