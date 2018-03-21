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
if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');
$gshop_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*
SC_BEGIN GSHOP_BALANCE
 global $gold_obj;
 return $gold_obj->formation($gold_obj->gold_balance(USERID));
SC_END

SC_BEGIN GSHOP_MESSAGE
global $gorb_message;
return $gorb_message;
SC_END

SC_BEGIN GSHOP_TITLE
global $gold_shop_title;
return $gold_shop_title;
SC_END

SC_BEGIN GSHOP_IMAGE
global $gold_shop_name,$gold_shop_url,$gold_shop_icon;
return '<a href="'.$gold_shop_url.'" ><img src="' . $gold_shop_icon . '" alt=""/></a>';
SC_END

SC_BEGIN GSHOP_DESCRIPTION
global $gold_shop_desc;
return $gold_shop_desc ;
SC_END

SC_BEGIN GSHOP_VISIT
global $gold_shop_name,$gold_shop_url;
return '<a href="'.$gold_shop_url.'" >'.GOLD_SHOP_01.' '.$gold_shop_name.'</a>';
SC_END


*/