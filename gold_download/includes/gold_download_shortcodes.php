<?php
/*
+---------------------------------------------------------------+
|        Gold Downloads for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
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
$gold_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*


SC_BEGIN GOLD_DLC_DOWNLOAD
global $download_name, $tp;
return $tp->toHTML($download_name, false);
SC_END

SC_BEGIN GOLD_DLC_COST
global $gold_charge, $gold_obj;
return $gold_obj->formation($gold_charge);
SC_END

SC_BEGIN GOLD_DLC_BALANCE
global $gold_dlbalance, $gold_obj;
return $gold_obj->formation($gold_dlbalance);
SC_END

SC_BEGIN GOLD_DLC_PROCEED
return '<input type="submit" class="button" name="gold_dlok" value="' . GOLD_DL_DLC06 . '" />';
SC_END

SC_BEGIN GOLD_DLC_CANCEL
return '<input type="submit" class="button" name="goldcancel" value="' . GOLD_DL_DLC07 . '" />';
SC_END


*/