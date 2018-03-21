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

include_lan(e_PLUGIN . 'gold_classes/languages/' . e_LANGUAGE . '.php');
if (!is_object($goldclass_obj))
{
    require_once(e_PLUGIN . 'gold_classes/includes/gold_classes_class.php');
    $goldclass_obj = new goldclasses;
}
$gold_class_list = unserialize($GOLD_CLASSPREF['gold_classes']);

// if adding then save or save if saving
if (isset($_POST['gold_update']) || isset($_POST['gold_addnew']))
{
    unset($gold_class_list);
    foreach($_POST['gold_class_threshold'] as $gold_class_threshold)
    {
        // print $_POST['gold_ucfrom'][$gold_class_threshold]."<br/>";
        if ($_POST['gold_delete'][$gold_class_threshold] == 1)
        {
            // delete this row
            // actually nothing to do...
        }
        else
        {
            $gold_class_list[$gold_class_threshold] = array("gold_class_shop" => $_POST['gold_class_shop'][$gold_class_threshold], "gold_classcost" => $_POST['gold_classcost'][$gold_class_threshold]);
            ksort($gold_class_list, SORT_NUMERIC);
            $GOLD_CLASSPREF['gold_classes'] = serialize($gold_class_list);
            $goldclass_obj->save_prefs();
            $gold_class_msg = ADLAN_GS_UCS04;
        }
    }
}
// If adding
if (isset($_POST['gold_addnew']))
{
    // create blank line
    $gold_class_list[] = array('gold_class_shop' => 255, "gold_classcost" => 0);
}
#print_a($gold_class_list);
$gold_class_text .= "
<form method='post' action='" . e_SELF . "' id='gold_uclass'>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='3'>" . ADLAN_GS_UCS02 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='3'><b>$gold_class_msg</b>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader2'><strong>" . ADLAN_GS_UCS05 . "</strong></td>
			<td style='width:40%' class='forumheader2'><strong>" . ADLAN_GS_UCS03 . "</strong></td>
			<td style='width:20%;text-align:center;' class='forumheader2' ><strong>" . ADLAN_GS_UCS07 . "</strong></td>
		</tr>";
// Get the existing records
// print_a($gold_class_list);
if (count($gold_class_list) > 0)
{
    foreach($gold_class_list as $gold_class_threshold => $gold_class_data)
    {
        // print "{$gold_class_threshold} {$gold_class_data['gold_classcost']}<br />";
        $gold_class_text .= "
		<tr>
			<td class='forumheader3' >" . r_userclass("gold_class_shop[$gold_class_threshold]", $gold_class_data['gold_class_shop'], "off", "nobody,classes") . "</td>
			<td class='forumheader3' >
				<input type='hidden' name='gold_class_threshold[]' value='" . $gold_class_threshold . "' />
				<input type='text' class='tbox' name='gold_classcost[$gold_class_threshold]' style='width:80%;' value='" . $gold_class_data['gold_classcost'] . "' />
			</td>
			<td class='forumheader3'style='text-align:center;'  >
				<input type='checkbox' class='tbox' name='gold_delete[$gold_class_threshold]'  value='1' />
			</td>
		</tr>";
		$gold_class_threshold++;
    }
    // } // while
}
else
{
    $gold_class_text .= "
		<tr>
			<td class='fcaption' colspan='3' style='text-align: left;'>" . ADLAN_GS_UCS10 . "</td>
		</tr>";
}
// Submit
$gold_class_text .= "
		<tr>
			<td class='fcaption' colspan='3' style='text-align: left;'>
				<input type='submit' name='gold_update' value='" . ADLAN_GS_UCS08 . "' class='button' />&nbsp;&nbsp;
				<input type='submit' name='gold_addnew' value='" . ADLAN_GS_UCS09 . "' class='button' />
			</td>
		</tr>
	</table>
</form>";
$ns->tablerender(ADLAN_GS_UCS01, $gold_class_text);
require_once(e_ADMIN . 'footer.php');

?>