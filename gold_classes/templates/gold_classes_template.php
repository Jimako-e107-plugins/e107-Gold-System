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
if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, 'width:100%;');
}
global $gold_class_shortcodes;
if (file_exists(THEME . 'images/gold_class_logo.png'))
{
    define(GOLDCLASS_LOGO, THEME . 'images/gold_class_logo.png');
} elseif (file_exists(e_PLUGIN . 'gold_classes/images/gold_class_logo.png'))
{
    define(GOLDCLASS_LOGO, e_PLUGIN . 'gold_classes/images/gold_class_logo.png');
}
if (!isset($GOLD_SHOP_CLASS_HEAD))
{
    $GOLD_SHOP_CLASS_HEAD .= '
<table class="fborder" style="' . USER_WIDTH . ';text-align: center">
	<tr>
		<td class="fcaption" style="text-align:left;" colspan="4">' . GOLD_CLASSES_01 . '</td>
	</tr>
		<tr>
		<td class="forumheader3" colspan="4" style="text-align:center;">';
    if (defined('GOLDCLASS_LOGO'))
    {
        $GOLD_SHOP_CLASS_HEAD .= '<img src="' . GOLDCLASS_LOGO . '" style="border:0;" alt="logo"/><br />';
    }
    $GOLD_SHOP_CLASS_HEAD .= GOLD_CLASSES_02 . ' : {GOLD_BUY_MYBALANCE}</td>
	</tr>
	<tr>
		<td class="fcaption" style="width: 20%">' . GOLD_CLASSES_03 . '</td>
		<td class="fcaption" style="width: 40%">' . GOLD_CLASSES_04 . '</td>
		<td class="fcaption" style="width: 20%;text-align:right;">' . GOLD_CLASSES_05 . '</td>
		<td class="fcaption" style="width: 20%;text-align:center;">' . GOLD_CLASSES_06 . '</td>
	</tr>';
}
if (!isset($GOLD_SHOP_CLASS_DETAIL))
{
    $GOLD_SHOP_CLASS_DETAIL .= '

	<tr>
		<td class="forumheader3" >{GOLD_BUY_CLASSNAME}</td>
		<td class="forumheader3" >{GOLD_BUY_DESCRIPTION}</td>
		<td class="forumheader3" style="text-align:right;">{GOLD_BUY_CLASS}</td>
		<td class="forumheader3" style="text-align:center;">{GOLD_BUY_BUTTON}</td>
	</tr>
';
}
if (!isset($GOLD_SHOP_CLASS_FOOT))
{
    $GOLD_SHOP_CLASS_FOOT .= '
	<tr>
		<td class="fcaption" style="text-align:center;" colspan="4">&nbsp;</td>
	</tr>
</table>';
}
if (!isset($GOLD_SHOP_NOTUSER))
{
    $GOLD_SHOP_NOTUSER .= '
<table class="fborder" style="' . USER_WIDTH . ';text-align: center">
	<tr>
		<td class="fcaption" style="text-align:left;">' . GOLD_CLASSES_01 . '</td>
	</tr>
		<tr>
		<td class="forumheader3" style="text-align:left;">' . GOLD_CLASSES_09 . '</td>
	</tr>
	<tr>
		<td class="fcaption" style="text-align:center;">&nbsp;</td>
	</tr>
</table>';
}
if (!isset($GOLD_SHOP_NOTGOLD))
{
    $GOLD_SHOP_NOTGOLD .= '
<table class="fborder" style="' . USER_WIDTH . ';text-align: center">
	<tr>
		<td class="fcaption" style="text-align:left;">' . GOLD_CLASSES_01 . '</td>
	</tr>
		<tr>
		<td class="forumheader3" style="text-align:left;">' . GOLD_CLASSES_10 . '</td>
	</tr>
	<tr>
		<td class="fcaption" style="text-align:center;">&nbsp;</td>
	</tr>
</table>';
}

