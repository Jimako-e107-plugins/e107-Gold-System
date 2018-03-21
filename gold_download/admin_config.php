<?php
/*
+---------------------------------------------------------------+
|        Gold Downloads for e107 v7xx - by Father Barry
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
require_once(e_HANDLER . 'userclass_class.php');

require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . 'gold_download/languages/' . e_LANGUAGE . '.php');
if (!is_object($gold_dl_obj))
{
    require_once(e_PLUGIN . 'gold_download/includes/gold_download_class.php');
    if (!is_object($gold_dl_obj))
    {
        $gold_dl_obj = new gold_dl;
    }
}
// if adding then save or save if saving
if (isset($_POST['gold_update']) || isset($_POST['gold_addnew']))
{
    // ensure new array is empty
    unset($gold_dlnewlist);
    foreach($_POST['gold_threshold'] as $gold_threshold)
    {
        // build new array
        if ($_POST['gold_delete'][$gold_threshold] == 1)
        {
            // delete this row by not including it
        }
        else
        {
            $gold_dlnewlist[] = array('gold_dl_class' => $_POST['gold_dl_class'][$gold_threshold], 'gold_dl_cost' => $_POST['gold_dl_cost'][$gold_threshold]);
        }
    }
    // serialize the array for writing in to prefs
    $GOLD_DL_PREF['gold_dlclasses'] = serialize($gold_dlnewlist);
    // write the array
    $gold_dl_obj->save_prefs();
    $gold_message = ADLAN_DL_DL04;
}
// check the list is empty
unset($gold_dllist);
$gold_dllist = unserialize($GOLD_DL_PREF['gold_dlclasses']);

if (isset($_POST['gold_addnew']))
{
    // If adding
    // create blank line
    $gold_dllist[] = array('gold_dl_class' => 0, 'gold_dl_cost' => 0);
}

$gold_text .= '
<form method="post" action="' . e_SELF . '" id="gold_uclass">
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td class="fcaption" colspan="3">' . ADLAN_DL_DL02 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="3"><b>' . $gold_message . '</b>&nbsp;</td>
		</tr>
		<tr>
			<td style="width:30%" class="forumheader2"><strong>' . ADLAN_DL_DL03 . '</strong></td>
			<td style="width:60%" class="forumheader2"><strong>' . ADLAN_DL_DL05 . '</strong></td>
			<td style="width:10%;text-align:center;" class="forumheader2" ><strong>' . ADLAN_DL_DL06 . '</strong></td>
		</tr>';
// Get the existing records
if (count($gold_dllist) > 0)
{
    foreach($gold_dllist as $gold_threshold => $gold_data)
    {
        $gold_text .= "
		<tr>
			<td class='forumheader3' >" . r_userclass("gold_dl_class[$gold_threshold]", $gold_data['gold_dl_class'], "off", "public,admin,main,classes") . "</td>
			<td class='forumheader3' >
				<input type='hidden' name='gold_threshold[]'  value='" . $gold_threshold . "' />
				<input type='text' class='tbox' name='gold_dl_cost[$gold_threshold]' style='width:20%;' value='" . $gold_data['gold_dl_cost'] . "' />
			</td>
			<td class='forumheader3'style='text-align:center;'  >
				<input type='checkbox' class='tbox' name='gold_delete[$gold_threshold]'  value='1' />
			</td>
		</tr>";
    }
    // } // while
}
else
{
    $gold_text .= "
		<tr>
			<td class='forumheader3' colspan='3' style='text-align: left;'>" . ADLAN_DL_DL10 . "</td>
		</tr>";
}
// Submit
$gold_text .= "
		<tr>
			<td class='fcaption' colspan='3' style='text-align: left;'>
				<input type='submit' name='gold_update' value='" . ADLAN_DL_DL08 . "' class='button' />&nbsp;&nbsp;
				<input type='submit' name='gold_addnew' value='" . ADLAN_DL_DL09 . "' class='button' />
			</td>
		</tr>
	</table>
</form>";
$ns->tablerender(ADLAN_DL_DL11, $gold_text);
require_once(e_ADMIN . 'footer.php');

?>