<?php
/*
+---------------------------------------------------------------+
|        Gold Download for e107 v7xx - by Father Barry
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
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}
global $gold_shortcodes;
if (!isset($GOLD_DL_CONFIRM_DL))
{
    $GOLD_DL_CONFIRM_DL = '
	<table class="fborder" style="' . USER_WIDTH . '" >
		<tr>
			<td class="fcaption" style="width:100%" >' . GOLD_DL_DLC01 . '</td>
		</tr>
		<tr>
			<td class="forumheader3" ><br />' . GOLD_DL_DLC02 . ' <b>{GOLD_DLC_DOWNLOAD}</b><br /><br />' . GOLD_DL_DLC03 . ' <b>{GOLD_DLC_COST}</b>. ' . GOLD_DL_DLC05 . ' <b>{GOLD_DLC_BALANCE}</b>
				<br /><br />' . GOLD_DL_DLC04 . '<br /><br />
				{GOLD_DLC_PROCEED}&nbsp;&nbsp;{GOLD_DLC_CANCEL}
			</td>
		</tr>
		<tr>
			<td class="fcaption" style="width:100%" >&nbsp;</td>
		</tr>
	</table>';
}
if (!isset($GOLD_DL_CONFIRM_NODL))
{
    $GOLD_DL_CONFIRM_NODL = '
	<table class="fborder" style="' . USER_WIDTH . '" >
		<tr>
			<td class="fcaption" style="width:100%" >' . GOLD_DL_DLC01 . '</td>
		</tr>
		<tr>
			<td class="forumheader3" ><br />' . GOLD_DL_DLC02 . ' <b>{GOLD_DLC_DOWNLOAD}</b><br /><br />' . GOLD_DL_DLC03 . ' <b>{GOLD_DLC_COST}</b>. ' . GOLD_DL_DLC05 . ' <b>{GOLD_DLC_BALANCE}</b>
				<br /><br />' . GOLD_DL_DLC08 . '<br /><br />
				{GOLD_DLC_CANCEL}
			</td>
		</tr>
		<tr>
			<td class="fcaption" style="width:100%" >&nbsp;</td>
		</tr>
	</table>';
}

?>