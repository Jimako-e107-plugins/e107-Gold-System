<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// to do - add trigger for updates to names etc.
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . 'gold_settings/languages/' . e_LANGUAGE . '.php');
require_once(e_PLUGIN . 'gold_settings/includes/gold_settings_shortcodes.php');
if (!is_object($gset_obj))
{
    require_once(e_PLUGIN . 'gold_settings/includes/gold_settings_class.php');
    $gset_obj = new gold_settings;
}

$title = GSET_GS_42;
define('e_PAGETITLE', $title);
global $GOLD_SETTINGS_PREF, $gold_obj;
require_once(e_HANDLER . 'ren_help.php');
$eplug_js[]=e_PLUGIN.'gold_settings/includes/gold_settings.js';
require_once(HEADERF);
require_once(e_PLUGIN . 'gold_settings/templates/gold_settings_template.php');
if (!USER)
{
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_NOTUSER, true, $gold_settings_shortcodes);
    $ns->tablerender($title, $gold_text);
    require_once(FOOTERF);
    exit;
}
if(strpos($_SERVER["HTTP_REFERER"],'usersettings.php')>0)
{
$gset_fromuser=true;
}
else
{
$gset_fromuser=false;
}
$page = '';
if (isset($_REQUEST['buy']))
{
    $page = $_REQUEST['buy'];
}
// $page = e_QUERY;
$gold_mybalance = $gold_obj->gold_balance(USERID);
$qry = "SELECT u.*, ue.* FROM #user AS u LEFT JOIN #user_extended AS ue ON ue.user_extended_id = u.user_id WHERE u.user_id='" . USERID . "'";
$sql->db_Select_gen($qry);
$curVal = $sql->db_Fetch();
$gold_param['gold_user_id'] = USERID;
$gold_param['gold_who_id'] = 0;
$gold_param['gold_action'] = 'debit';
$gold_param['gold_plugin'] = 'gold_system';
// *****************************************************************************************************
// *
// *	Process any updates to sig, name ,title or avatar
// *
// *****************************************************************************************************
if (isset($_POST['preview']))
{
    $page = "signature";
}
if (IsSet($_POST['update']))
{
    $page = "";
    // *****************************************************************************************************
    // *
    // *	Purchase of Custom Title
    // *
    // *****************************************************************************************************
    if ($_POST['gold_action'] == 'gold_title')
    {
        if (strlen($_POST['customtitle']) > $pref['displayname_maxlength'])
        {
            $message = GSET_GS_60;
        } elseif ($gold_mybalance < $GOLD_SETTINGS_PREF['gset_customtitle'])
        {
            $message = GSET_GS_44;
        }
        else
        {
            // update title
            if ($sql->db_Update('user', 'user_customtitle="' . $tp->toDB($_POST['customtitle']) . '" WHERE user_id="' . USERID . '" '))
            {
                post_user_trigger();
                $gold_param['gold_amount'] = $GOLD_SETTINGS_PREF['gset_customtitle'];
                $gold_param['gold_type'] = GSET_GS_S25;
                $gold_param['gold_log'] = GSET_GS_S16 . ' ' . GSET_GS_S05 . ' - ' . $_POST['customtitle'];
                $gold_res = $gold_obj->gold_modify($gold_param);
                $message = GSET_GS_61 . " " . $_POST['customtitle'];
            }
        }
    }
    // *****************************************************************************************************
    // *
    // *	Purchase of Custom Name
    // *
    // *****************************************************************************************************
    if ($_POST['gold_action'] == 'gold_name')
    {
        $gold_noname = explode(',', $pref['signup_disallow_text']);
        if (strlen($_POST['display_name']) > $pref['displayname_maxlength'])
        {
            $message = GSET_GS_48;
        } elseif (in_array(strtolower($_POST['display_name']), $gold_noname))
        {
            $message = GSET_GS_S29;
        } elseif ($gold_mybalance < $GOLD_SETTINGS_PREF['gset_name'])
        {
            $message = GSET_GS_44;
        }
        else
        {
            if ($sql->db_Select('user', 'user_name', 'where user_name="' . $tp->toDB($_POST['display_name']) . '" and user_id!="' . USERID . '"', 'nowhere', false))
            {
                // name in use by another
                $message = GSET_GS_S28;
            }
            else
            {
                if ($sql->db_Update('user', 'user_name="' . $tp->toDB($_POST['display_name']) . '" WHERE user_id="' . USERID . '" ', false))
                {
                    post_user_trigger();
                    $gold_param['gold_amount'] = $GOLD_SETTINGS_PREF['gset_name'];
                    $gold_param['gold_type'] = GSET_GS_S25;
                    $gold_param['gold_log'] = GSET_GS_S16 . " " . GSET_GS_33 . " - " . $_POST['display_name'];

                    $gold_res = $gold_obj->gold_modify($gold_param);
                    $message = GSET_GS_49 . ' ' . $_POST['display_name'];
                    // $gold_obj->load_gold(USERID);
                    if ($gold_obj->plugin_active('gold_orb'))
                    {
                        // check if orb exists - if so then delete old one.
                        if (file_exists(e_PLUGIN . 'gold_orb/wield/' . USERID . '.png'))
                        {
                            unlink(e_PLUGIN . 'gold_orb/wield/' . USERID . '.png');
                        }
                        if (!is_object($gorb_obj))
                        {
                            require_once(e_PLUGIN . 'gold_orb/includes/gold_orb_class.php');
                            $gorb_obj = new gold_orb;
                        }
                        $gorb_obj->gen_orb(USERID, $gold_obj->gold_member[USERID]['user_name'], $gold_obj->gold_member[USERID]['gold_orb']);
                    }
                }
            }
        }
    }
    // *****************************************************************************************************
    // *
    // *	Purchase of Custom Signature
    // *
    // *****************************************************************************************************
    if ($_POST['gold_action'] == 'gold_signature')
    {
        if ($gold_mybalance < $GOLD_SETTINGS_PREF['gset_signature'])
        {
            $message = GSET_GS_44;
        }
        else
        {
            if ($sql->db_Update('user', 'user_signature="' . $tp->toDB($_POST['signature']) . '" WHERE user_id="' . USERID . '" ', false))
            {
                post_user_trigger();
                $gold_param['gold_amount'] = $GOLD_SETTINGS_PREF['gset_signature'];
                $gold_param['gold_type'] = GSET_GS_S25;
                $gold_param['gold_log'] = GSET_GS_S16 . ' ' . GSET_GS_S07 ;
                $gold_res = $gold_obj->gold_modify($gold_param);
                $message = GSET_GS_50;
            }
        }
    }
    // *****************************************************************************************************
    // *
    // *	Purchase of Custom Avatar
    // *
    // *****************************************************************************************************
    if ($_POST['gold_action'] == 'gold_avatar')
    {
        if ($file_userfile['error'] != 4)
        {
            require_once(e_HANDLER . 'upload_handler.php');
            require_once(e_HANDLER . 'resize_handler.php');
            $pref['im_width'] = ($pref['im_width']) ? $pref['im_width'] : 120;
            $pref['im_height'] = ($pref['im_height']) ? $pref['im_height'] : 100;
            if ($uploaded = file_upload(e_FILE . 'public/avatars/', 'avatar'))
            {
                if ($uploaded[0]['name'] && $pref['avatar_upload'])
                {
                    // avatar uploaded
                    $_POST['image'] = "-upload-" . $uploaded[0]['name'];
                    if (!resize_image(e_FILE . 'public/avatars/' . $uploaded[0]['name'], e_FILE . 'public/avatars/' . $uploaded[0]['name'], 'avatar'))
                    {
                        unset($message);
                        $error .= RESIZE_NOT_SUPPORTED . "\\n";
                        @unlink(e_FILE . 'public/avatars/' . $uploaded[0]['name']);
                    }
                }
                if ($uploaded[1]['name'] || (!$pref['avatar_upload'] && $uploaded[0]['name']))
                {
                    // photograph uploaded
                    $user_sess = ($pref['avatar_upload'] ? $uploaded[1]['name'] : $uploaded[0]['name']);
                    resize_image(e_FILE . 'public/avatars/' . $user_sess, e_FILE . 'public/avatars/' . $user_sess, 180);
                }
            }
        }
        if ($gold_mybalance < $GOLD_SETTINGS_PREF['gset_avatar'])
        {
            $message = GSET_GS_44;
        }
        else
        {
            if ($_POST['avatar'])
            {
                $size = getimagesize($_POST['avatar']);
                $width = $size[0];
                $height = $size[1];
                if ($_POST['avatar'] == $curVal['user_image'])
                {
                    $message = GSET_GS_S31;
                }
                else if (($width > $pref['im_width']) || ($height > $pref['im_height']))
                {
                    $message = GSET_GS_S30 . " {$pref['im_width']} x {$pref['im_height']}";
                }
                else
                {
                    if ($sql->db_Update('user', 'user_image="' . $tp->toDB($_POST['avatar']) . '" WHERE user_id="' . USERID . '" ', false))
                    {
                        post_user_trigger();
                        $gold_param['gold_amount'] = $GOLD_SETTINGS_PREF['gset_avatar'];
                        $gold_param['gold_type'] = GSET_GS_S25;
                        $gold_param['gold_log'] = GSET_GS_S16 . ' ' . GSET_GS_S08 ;
                        $gold_res = $gold_obj->gold_modify($gold_param);
                        $message = GSET_GS_S26 ;
                    }
                }
            }
            else
            {
                if ($sql->db_Update('user', 'user_image="' . $tp->toDB($_POST['image']) . '" WHERE user_id="' . USERID . '" ', false))
                {
                    post_user_trigger();
                    $gold_param['gold_amount'] = $GOLD_SETTINGS_PREF['gset_avatar'];
                    $gold_param['gold_type'] = GSET_GS_S25;
                    $gold_param['gold_log'] = GSET_GS_S16 . ' ' . GSET_GS_S08 ;
                    $gold_res = $gold_obj->gold_modify($gold_param);
                    $message = GSET_GS_S26 ;
                }
            }
        }
    }
}
$gold_obj->load_gold(USERID);
$gold_mybalance = $gold_obj->gold_balance(USERID);
if ($page == '' || IsSet($_GET['buy']))
{
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_HEADER, true, $gold_settings_shortcodes);
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_TITLE, true, $gold_settings_shortcodes);
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_CLASS_HEAD, true, $gold_settings_shortcodes);
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_CLASS_DETAIL, true, $gold_settings_shortcodes);
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_CLASS_FOOT, true, $gold_settings_shortcodes);
}

if ($page == 'custom_title')
{
    IsSet($_POST['customtitle']) ? $display = $_POST['customtitle'] : $display = $curVal['user_customtitle'];
    $title .= ' - ' . GSET_GS_58;
    $gold_text = '
<div style="text-align:center;">
	<form method="post"  id="dataform" action="' . e_SELF . '" >
		<div>
			<input type="hidden" name="gold_action" value="gold_title" />
		</div>';
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_CUSTOMTITLE, true, $gold_settings_shortcodes);

    $gold_text .= '
	</form>
</div>';
}

if ($page == 'display_name')
{
    IsSet($_POST['display_name']) ? $display = $_POST['display_name'] : $display = $curVal['user_name'];
    $title .= ' -- ' . GSET_GS_33;
    $gold_text = "
<div style='text-align: center'>
	<form method='post' id='dataform' action='" . e_SELF . "' >
		<div>
			<input type='hidden' name='gold_action' value='gold_name' />
		</div>	";

    $gold_text .= $tp->parsetemplate($GOLD_SHOP_DISPLAYNAME, true, $gold_settings_shortcodes);
    $gold_text .= "
	</form>
</div>
";
}
if ($page == 'signature')
{
    IsSet($_POST['signature']) ? $display = $_POST['signature'] : $display = $curVal['user_signature'];
    $title .= ' -- ' . GSET_GS_35;
    if (!isset($_POST['signature']))
    {
        $_POST['signature'] = $curVal['user_signature'];
    }
    $gold_text = "
<div style='text-align: center'>
	<form method='post' id='dataform' action='" . e_SELF . "'>
		<div>
			<input type='hidden' name='gold_action' value='gold_signature' />
		</div>";
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_SIGNATURE, true, $gold_settings_shortcodes);
    $gold_text .= "
	</form>
</div>
";
}
if ($page == 'avatar')
{
    if ($pref['avatar_upload'] == 1)
    {
        $upload = '';
        $upload_value = '';
        $addtext_us = "
		<script type='text/javascript'>
			function addtext_us(sc){
				document.getElementById('dataform').avatar.value = sc;
				document.getElementById('dataform').avatar.disabled = '';
				document.getElementById('upload').value = '';
				document.getElementById('upload').disabled = 'true';
			}
			function avatar_remote() {
				document.getElementById('upload').value = '';
				document.getElementById('upload').disabled = 'true';
			}
			function avatar_upload() {
				document.getElementById('dataform').avatar.value = '';
				document.getElementById('dataform').avatar.disabled = 'true';
			}
			function avatar_reset() {
				document.getElementById('upload').disabled = '';
				document.getElementById('dataform').avatar.disabled = '';
			}
		</script>";
    }
    else
    {
        $upload = 'disabled ';
        $upload_value = GSET_GS_S27; // disabled by admin
        $addtext_us = "
		<script type='text/javascript'>
			function addtext_us(sc){
				document.getElementById('dataform').avatar.value = sc;
				document.getElementById('dataform').avatar.disabled = '';
			}
			function avatar_remote() {
				void(0);
			}
			function avatar_upload() {
				document.getElementById('dataform').avatar.value = '';
				document.getElementById('dataform').avatar.disabled = 'true';
			}
			function avatar_reset() {
				document.getElementById('dataform').avatar.disabled = '';
			}
		</script>";
    }

    $ret = "
	<input class='button' type='button' style='cursor:hand' size='30' value='" . GSET_GS_56 . "' onclick='expandit(this)' />
	<div style='display:none'>";
    $avatarlist[0] = "";
    $handle = opendir(e_IMAGE . 'avatars/');
    while ($file = readdir($handle))
    {
        if ($file != '.' && $file != '..' && $file != 'index.html' && $file != 'CVS' && $file != 'Thumbs.db')
        {
            $avatarlist[] = $file;
        }
    }
    closedir($handle);

    for($c = 1; $c <= (count($avatarlist)-1); $c++)
    {
        $ret .= "<a href='javascript:addtext_us(\"$avatarlist[$c]\")'><img src='" . e_IMAGE . "avatars/" . $avatarlist[$c] . "' style='border:0' alt='' /></a>\n";
    }

    $ret .= '
	<br />
	</div>
	';
    $title .= ' -- Avatar';
    $gold_text = "{$addtext_us}
<div style='text-align: center'>
	<form method='post' id='dataform' enctype='multipart/form-data' onreset=\"avatar_reset();\">
		<div>
			<input type='hidden' name='gold_action' value='gold_avatar' />
		</div>	";
    $gold_userimage = $currentUser['user_image'];
    $gold_text .= $tp->parsetemplate($GOLD_SHOP_AVATAR, true, $gold_settings_shortcodes);
    $gold_text .= '
	</form>
</div>
';
}

$gold_text .= '</div>
<script>
var gold_settings_confirm_pre="'.GSET_GS_S32.'"
var gold_settings_confirm_post="'.GSET_GS_S33.'"
</script>
';

$ns->tablerender($title, $gold_text);
require_once(FOOTERF);

function post_user_trigger()
{
    global $e_event;

    $gold_sql2 = new db;
    // get extended structure
    $gold_sql2->db_Select('user_extended_struct', 'user_extended_struct_name');
    $ue_struct = $gold_sql2->db_getList();
    // get the user's details
    $gold_arg = "select * from #user left join #user_extended on user_id=user_extended_id where user_id='" . USERID . "'";
    $gold_sql2->db_Select_gen($gold_arg, false);
    $gold_row = $gold_sql2->db_Fetch();

    // *
    $data['username'] = $gold_row['user_name'];
    $data['loginname'] = $gold_row['user_loginname'];
    $data['realname'] = $gold_row['user_login'];
    $data['customtitle'] = $gold_row['user_customtitle'];
    $data['email'] = $gold_row['user_email'];
    $data['hideemail'] = $gold_row['user_hideemail'];
    $data['class'] = explode(',', $gold_row['user_class']);
    $data['signature'] = $gold_row['user_signature'];
    $data['timezone'] = $gold_row['user_timezone'];
    $data['image'] = $gold_row['user_image'];
    $data['user_xup'] = $gold_row['user_xup'];
    $data['user_id'] = $gold_row['user_id'];
    $data['_uid'] = $gold_row['user_id'];
    foreach($ue_struct as $struline)
    {
        $ue[$struline['user_extended_struct_name']] = $gold_row['user_' . $struline['user_extended_struct_name']];
    }
    $data['ue'] = $ue;
    $e_event->trigger("postuserset", $data);
}

?>