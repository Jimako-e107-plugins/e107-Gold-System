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
include_lan(e_PLUGIN . 'gold_settings/languages/readme/' . e_LANGUAGE . '.php');
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
require(e_PLUGIN . 'gold_settings/plugin.php');
$gold_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . GSETT_R01 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R02 . "</td>
		<td class='forumheader3'>" . $eplug_name . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R06 . "</td>
		<td class='forumheader3'>" . $eplug_version . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R08 . "</td>
		<td class='forumheader3'>" . GSETT_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R10 . "</td>
		<td class='forumheader3'>" . GSETT_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R12 . "</td>
		<td class='forumheader3'>" . GSETT_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R14 . "</td>
		<td class='forumheader3'>" . GSETT_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R16 . "</td>
		<td class='forumheader3'>" . GSETT_R17 . "</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:15%;' >" . GSETT_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . GSETT_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . GSETT_R18 . "</strong><br /><br />" . GSETT_R19 . "<br /><br />
		<strong>" . GSETT_R20 . "</strong><br /><br />" . GSETT_R21 . "<br /><br />
		<strong>" . GSETT_R22 . "</strong><br /><br />" . GSETT_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender(GSETT_R01, $gold_text);

require_once(e_ADMIN . 'footer.php');

?>