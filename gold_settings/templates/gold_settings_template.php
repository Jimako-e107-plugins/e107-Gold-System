<?php
/*
+---------------------------------------------------------------+
|        Gold Settings for e107 v7xx - by Father Barry
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
global $gold_settings_shortcodes;
// *********************************************************************************************************
// *
// *		Template for shop page
// *
// *********************************************************************************************************
if (!isset($GOLD_SHOP_HEADER))
{
    $GOLD_SHOP_HEADER .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption">' . GSET_GS_S19 . '</td>
	<tr>
	<tr>
		<td class="forumheader2"><b>{GOLD_SHOP_MESSAGE}</b>&nbsp;</td>
	<tr>
	<tr>
		<td class="forumheader3">' . GSET_GS_S15 . ' {GOLD_SHOP_BALANCE}</td>
	<tr>
</table>		';
}
if (!isset($GOLD_SHOP_TITLE))
{
    $GOLD_SHOP_TITLE .= '
<table class="fborder" style="' . USER_WIDTH . '">
	<tr>
		<td rowspan="4" class="fcaption" style="width:33%;text-align:center;" >
			<img src="' . e_PLUGIN . 'gold_system/images/merchant.gif" border="0">
		</td>
		<td class="forumheader2" style="width:46%">
			' . GSET_GS_58 . '<br /><span class="smalltext">' . GSET_GS_59 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_CUSTOMTITLE} {GOLD_BUY_TITLE_BUTTON}</td>
	</tr>

	<tr>
		<td class="forumheader2" style="width:33%;">
			' . GSET_GS_33 . '<br /><span class="smalltext">' . GSET_GS_34 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_DISPLAY} {GOLD_BUY_NAME_BUTTON}</td>
	</tr>

	<tr>
		<td class="forumheader2" style="width:33%;">
			' . GSET_GS_35 . '<br /><span class="smalltext">' . GSET_GS_36 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_SIGNATURE} {GOLD_BUY_SIGNATURE_BUTTON}</td>
	</tr>

	<tr>
		<td class="forumheader2" style="width:33%;">
			' . GSET_GS_37 . '<br /><span class="smalltext">' . GSET_GS_38 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_AVATAR} {GOLD_BUY_AVATAR_BUTTON}</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="4">&nbsp;</td>
	</tr>
</table>';
}

if (!isset($GOLD_SHOP_CUSTOMTITLE))
{
    $GOLD_SHOP_CUSTOMTITLE .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . GSET_GS_S05 . '</td>
	</tr>
		<tr>
		<td class="forumheader2" colspan="2">{GOLD_BUY_UPDIR}</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%;" >' . GSET_GS_58 . '<br /><span class="smalltext">' . GSET_GS_59 . '</span></td>
		<td class="forumheader3">{GOLD_BUY_TITLE}</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:center">{GOLD_BUY_SUBMIT}</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2">&nbsp;</td>
	</tr>
</table>';
}
if (!isset($GOLD_SHOP_DISPLAYNAME))
{
    $GOLD_SHOP_DISPLAYNAME .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . GSET_GS_S04 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2">{GOLD_BUY_UPDIR}</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%;" >' . GSET_GS_33 . '<br /><span class="smalltext">' . GSET_GS_34 . '</span></td>
		<td class="forumheader3">{GOLD_BUY_DISPLAYNAME}</td>
	</tr>
	<tr>
		<td class="forumheader" colspan="2" style="text-align:center">{GOLD_BUY_SUBMIT}</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2">&nbsp;</td>
	</tr>
</table>';
}

if (!isset($GOLD_SHOP_SIGNATURE))
{
    $GOLD_SHOP_SIGNATURE .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . GSET_GS_S07 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2">{GOLD_BUY_UPDIR}</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2">' . GSET_GS_S20 . '</td>
	</tr>

	<tr>
		<td class="forumheader3" colspan="2">{GOLD_BUY_SIGPREVIEW}&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader3" style="vertical-align:top;" >' . GSET_GS_35 . '<br /><span class="smalltext">' . GSET_GS_36 . '</span></td>
		<td class="forumheader2">{GOLD_BUY_SIGNATURE}
		</td>
	</tr>
	<tr>
		<td class="forumheader" colspan="2" style="text-align:center">
		{GOLD_BUY_PREVIEW}&nbsp;&nbsp;{GOLD_BUY_SUBMIT}
		</td>
	</tr>
</table>
';
}

if (!isset($GOLD_SHOP_AVATAR))
{
    $GOLD_SHOP_AVATAR .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . GSET_GS_S08 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2">{GOLD_BUY_UPDIR}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . GSET_GS_S21 . '<br /><span class="smalltext">' . GSET_GS_S22 . '</span></td>
		<td class="forumheader3">{GOLD_BUY_AVATAR_IMAGE}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . GSET_GS_S23 . '<br /><span class="smalltext">{GOLD_BUY_AVATAR_STATUS}</span></td>
		<td class="forumheader3">{GOLD_BUY_AVATAR_UPLOAD}</td>
	</tr>
	<tr>
		<td class="forumheader3" style="vertical-align:top;" >' . GSET_GS_53 . '<br /><span class="smalltext">' . GSET_GS_54 . '</span></td>
		<td class="forumheader3" style="vertical-align:top;" >{GOLD_BUY_SITEAVATAR}</td>
	</tr>
	<tr>
		<td class="forumheader" colspan="2" style="text-align:center">{GOLD_BUY_SUBMIT}&nbsp;&nbsp;{GOLD_BUY_RESET}</td>
	</tr>
</table>';
}
if (!isset($GOLD_SHOP_NOTUSER))
{
    $GOLD_SHOP_NOTUSER .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . GSET_GS_42 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" colspan="2">' . GSET_GS_S24 . '</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2">&nbsp;</td>
	</tr>
</table>';
}
