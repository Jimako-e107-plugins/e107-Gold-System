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
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}
global $gold_shop_shortcodes;
// *********************************************************************************************************
// *
// *		Template for shop.php Shop page
// *
// *********************************************************************************************************
if (!isset($GOLD_SHOP_HEADER))
{
    $GOLD_SHOP_HEADER .= '
<table class="fborder" style="' . USER_WIDTH . '" >
		<tr>
			<td class="fcaption" colspan="3">' . GOLD_SHOP_03 . '</td>
		</tr>';
    if (defined('GSHOP_LOGO'))
    {
        $GOLD_SHOP_HEADER .= '
		<tr>
			<td class="forumheader2" style="text-align:center;" colspan="3"><img src="' . GSHOP_LOGO . '" alt="" style="border:0px" /></td>
		</tr>';
    }
    $GOLD_SHOP_HEADER .= '
		<tr>
			<td class="forumheader2" style="text-align:center;" colspan="3">' . GOLD_SHOP_02 . ' {GSHOP_BALANCE}<br />{GSHOP_MESSAGE}&nbsp;</td>
		</tr>';
}

if (!isset($GOLD_SHOP_FOOTER))
{
    $GOLD_SHOP_FOOTER .= '
		<tr>
			<td class="forumheader2" colspan="3">&nbsp;</td>
		</tr>
	</table>';
}
if (!isset($GOLD_SHOP_DETAIL))
{
    $GOLD_SHOP_DETAIL .= '
			<tr>
				<td class="fcaption" style="text-align:left" colspan="3">{GSHOP_TITLE}</td>
			</tr>
			<tr>
				<td class="forumheader3" style="width:20%;text-align:center">{GSHOP_IMAGE}</td>
				<td class="forumheader3" style="width:60%;text-align:left">{GSHOP_DESCRIPTION}</td>
				<td class="forumheader3" style="width:20%;text-align:center">{GSHOP_VISIT}</td>
			</tr>
';
}
if (!isset($GOLD_SHOP_NODETAIL))
{
    $GOLD_SHOP_NODETAIL .= '
			<tr>
				<td class="fcaption" style="text-align:left" colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td class="forumheader3" style="text-align:left" colspan="3">'.GOLD_SHOP_05.'</td>
			</tr>
';
}

