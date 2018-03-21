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
if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');
$gold_class_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*

SC_BEGIN GOLD_BUY_CLASSNAME
global $gold_class_classname,$tp;
return $tp->toHTML($gold_class_classname);
SC_END

SC_BEGIN GOLD_BUY_DESCRIPTION
global $gold_class_classdesc,$tp;
return $tp->toHTML($gold_class_classdesc);
SC_END

SC_BEGIN GOLD_BUY_CLASS
global $gold_obj,$gold_class_cost;
return $gold_obj->formation($gold_class_cost);
SC_END

SC_BEGIN GOLD_BUY_CLASSJOIN
global $gold_obj,$gold_class_member,$gold_class_id;
return '<input type="checkbox" class="tbox" value="1" name="gold_class_member['.$gold_class_id.']" '.($gold_class_member==1?'checked="checked"':'').' />';
SC_END

SC_BEGIN GOLD_BUY_BUTTON
global $gold_class_id,$gold_class_member,$gold_class_cost,$gold_mybalance;
if($gold_class_member==1)
{
	return 'Already a member';
}
else
{
	if($gold_mybalance > $gold_class_cost)
	{
		return '<input type="submit" class="button" name="goldclass_submit['.$gold_class_id.']" value="'.GOLD_CLASSES_07.'" /> ';
	}
	else
	{
		return 'Insufficient funds';
	}
}
SC_END

SC_BEGIN GOLD_BUY_MYBALANCE
global $gold_obj,$gold_mybalance;
return $gold_obj->formation($gold_mybalance);
SC_END
*/