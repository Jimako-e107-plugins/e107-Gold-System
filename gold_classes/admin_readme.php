<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
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
include_lan(e_PLUGIN . 'gold_classes/languages/readme/' . e_LANGUAGE . '.php');
require_once(e_ADMIN . 'auth.php');
require(e_PLUGIN . 'gold_classes/plugin.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
$eventguide_text = '
<table class="fborder" style="' . ADMIN_WIDTH . '">
	<tr>
		<td class="fcaption" colspan="2">' . GOLD_CLASS_R01 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R02 . '</td>
		<td class="forumheader3">' . $eplug_name . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R04 . '</td>
		<td class="forumheader3">' . $eplug_author . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R06 . '</td>
		<td class="forumheader3">' . $eplug_version . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R08 . '</td>
		<td class="forumheader3">' . GOLD_CLASS_R09 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R10 . '</td>
		<td class="forumheader3">' . GOLD_CLASS_R11 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R12 . '</td>
		<td class="forumheader3">' . GOLD_CLASS_R13 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R14 . '</td>
		<td class="forumheader3">' . GOLD_CLASS_R15 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:15%;" >' . GOLD_CLASS_R16 . '</td>
		<td class="forumheader3">' . GOLD_CLASS_R17 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" colspan="2">
		<strong>' . GOLD_CLASS_R18 . '</strong><br /><br />' . GOLD_CLASS_R19 . '<br /><br />
		<strong>' . GOLD_CLASS_R20 . '</strong><br /><br />' . GOLD_CLASS_R21 . '<br /><br />
		<strong>' . GOLD_CLASS_R22 . '</strong><br /><br />' . GOLD_CLASS_R23 . '
		</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2">&nbsp;</td>
	</tr>
</table>';
$ns->tablerender(GOLD_CLASS_R01, $eventguide_text);

require_once(e_ADMIN . 'footer.php');

?>