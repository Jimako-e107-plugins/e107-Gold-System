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

include_lan(e_PLUGIN . 'gold_classes/languages/' . e_LANGUAGE . '.php');
require_once(e_PLUGIN . 'gold_classes/includes/gold_classes_shortcodes.php');
$title = GOLD_CLASSES_08;
define('e_PAGETITLE', $title);
global $GOLD_CLASSPREF, $goldclass_obj;
if (!is_object($goldclass_obj))
{
    require_once(e_PLUGIN . 'gold_classes/includes/gold_classes_class.php');
    $goldclass_obj = new goldclasses;
}
require_once(HEADERF);

require_once(e_PLUGIN . 'gold_classes/templates/gold_classes_template.php');
require_once(GOLD_CLASS_THEME);

if (!is_object($gold_obj) || !$gold_obj->plugin_active('gold_classes') || !USER)
{
    if (!is_object($gold_obj) || !$gold_obj->plugin_active('gold_classes'))
    {
        $gold_class_text .= $tp->parsetemplate($GOLD_SHOP_NOTGOLD, true, $gold_class_shortcodes);
    }
    else
    {
        $gold_class_text .= $tp->parsetemplate($GOLD_SHOP_NOTUSER, true, $gold_class_shortcodes);
    }

    $ns->tablerender($title, $gold_class_text);
    require_once(FOOTERF);
    exit;
}
$gold_class_list = unserialize($GOLD_CLASSPREF['gold_classes']);
// print_a($gold_class_list);
$sql->db_Select('userclass_classes', 'userclass_id,userclass_name,userclass_description', 'order by userclass_name', 'nowhere', false);
while ($row = $sql->db_Fetch())
{
    $gold_class_allclass[$row['userclass_id']] = array($row['userclass_name'], $row['userclass_description']);
}
$sql->db_Select('user', 'user_class', 'where user_id=' . USERID, 'nowhere', false);
extract($sql->db_Fetch());
$gold_classes_mine = explode(',', $user_class);
// $gold_classes_mine = explode(',', USERCLASS_LIST);
// print_a($gold_classes_mine);
$gold_mybalance = $gold_obj->gold_balance(USERID);

if (IsSet($_POST['goldclass_submit']))
{
    $gold_class_newlist = $_POST['goldclass_submit'];
    foreach($gold_class_newlist as $key => $row)
    {
        // print "row $key <br />";
        if (in_array($key, $gold_classes_mine))
        {
            // already in list
        }
        else
        {
            // not in list so add it
            // now charge for the class
            $gold_classes_mine[] = $key;
            // get the cost and class name
            foreach($gold_class_list as $gold_classrow)
            {
                if ($gold_classrow['gold_class_shop'] == $key)
                {
                    $cost = $gold_classrow['gold_classcost'];
                    $sql->db_Select('userclass_classes', 'userclass_name', 'where userclass_id=' . $key, false);
                    $classname = $sql->db_Fetch();
                }
            }
            if ($cost < $gold_mybalance)
            {
                // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
                // *				: 	$gold_param['gold_who_id'] (default no user)
                // *				:	$gold_param['gold_amount'] (default no amount)
                // *				:	$gold_param['gold_type'] (default "adjustment")
                // *				:	$gold_param['gold_action'] 	credit - add to account
                // *												debit - subtract from account
                // *				:	$gold_param['gold_plugin'] (default no plugin)
                // *				:	$gold_param['gold_log'] (default "")
                // *				:	$gold_param['gold_forum'] (default 0)
                $gold_param['gold_user_id'] = USERID;
                $gold_param['gold_who_id'] = 0;
                $gold_param['gold_action'] = 'debit';
                $gold_param['gold_plugin'] = 'gold_classes';
                $gold_param['gold_amount'] = $cost;
                $gold_param['gold_type'] = 'Purchase Class';
                $gold_param['gold_action'] = 'debit';
                $gold_param['gold_plugin'] = 'gold_classes';
                $gold_param['gold_log'] = 'Purchased user class : ' . $classname['userclass_name'];
                $gold_obj->gold_modify($gold_param);
                $gold_classes_unique = array_unique($gold_classes_mine);
                sort($gold_classes_unique);

                $gold_classes_new = implode(',', $gold_classes_unique);

                $sql->db_Update('user', 'user_class="' . $gold_classes_new . '" where user_id=' . USERID, false);
            }
        }
    }
}

$gold_class_text = "
<div style='text-align: left'>
	<form method='post' id='dataform' action='" . e_SELF . "'>
		<div>
			<input type='hidden' name='gold_classes' value='gold_classes' />
		</div>";
$gold_class_text .= $tp->parsetemplate($GOLD_SHOP_CLASS_HEAD, true, $gold_class_shortcodes);
foreach($gold_class_list as $gold_class_row)
{
    $gold_class_id = $gold_class_row['gold_class_shop'];
    $gold_class_classname = $gold_class_allclass[$gold_class_id][0];
    $gold_class_classdesc = $gold_class_allclass[$gold_class_id][1];
    $gold_class_cost = $gold_class_row['gold_classcost'];
    if (in_array($gold_class_id, $gold_classes_mine))
    {
        $gold_class_member = 1;
    }
    else
    {
        $gold_class_member = 0;
    }
    $gold_class_text .= $tp->parsetemplate($GOLD_SHOP_CLASS_DETAIL, true, $gold_class_shortcodes);
}
$gold_class_text .= $tp->parsetemplate($GOLD_SHOP_CLASS_FOOT, true, $gold_class_shortcodes);
$gold_class_text .= "
	</form>
</div>
";

$gold_class_text .= '</div>';

$ns->tablerender($title, $gold_class_text);
require_once(FOOTERF);

?>