<?php
/*
+---------------------------------------------------------------+
|        Gold Downloads for e107 v7xx - by Father Barry
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
require_once(e_HANDLER . 'userclass_class.php');
if (isset($_POST['gold_dlok']))
{
 
    $url = $_POST['gold_url'];
    session_start();
    $_SESSION['gold_dl'] = $_POST['gold_url'];
    header("Location:{$url}");
 
    exit;
} elseif (isset($_POST['goldcancel']))
{
    $url = SITEURL . '/download.php';
    session_start();
    $_SESSION['gold_dl'] = 0;
    header("Location:{$url}");
    exit;
}
else
{
    session_start();

    include_lan(e_PLUGIN . 'gold_download/languages/' . e_LANGUAGE . '.php');
    require_once(e_PLUGIN . 'gold_download/includes/gold_download_shortcodes.php');
    require_once(e_PLUGIN . 'gold_download/templates/gold_download_template.php');
    
 
    
    // $title = LAN_GS_42;
    // define("e_PAGETITLE", $title);
    global $GOLD_DL_PREF, $gold_obj;

    require_once(HEADERF);
    require_once(GOLD_THEME);
    $gold_request = e_QUERY;  
    $gold_sql->db_Select('download', 'download_id,download_name', 'where download_id="' . $gold_request . '" or download_name="' . $gold_request . '"', 'nowhere', false);
    $download  = $gold_sql->db_Fetch(); 
    extract($gold_sql->db_Fetch());
   $gold_dllist = unserialize($GOLD_DL_PREF['gold_dlclasses']);
    if (count($gold_dllist > 0))
    {
        $gold_ulist = explode(',', USERCLASS_LIST);
        $gold_dlbalance = $gold_obj->gold_balance(USERID);
        $gold_charge = 999999999;
        foreach($gold_dllist as $gold_row)
        {
        $gold_class =$gold_row['gold_dl_class'];
        $gold_cost =$gold_row['gold_dl_cost'];

            // print "$gold_class $gold_cost<br>";
            if (in_array($gold_class, $gold_ulist))
            {
                $gold_charge = min($gold_charge, $gold_cost);
            }
        }
        
        $download_request_url = e107::url('download', 'get', $download);
        $gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_dl">
	<div>
		<input type="hidden" name="gold_url" value="' . $download_request_url . '" />
	</div>';

        if ($gold_charge < $gold_dlbalance)
        {
            $gold_text .= $tp->parsetemplate($GOLD_DL_CONFIRM_DL, true, $gold_shortcodes);
            $_SESSION['gold_dl'] = $gold_request;
        }
        else
        {
            $gold_text .= $tp->parsetemplate($GOLD_DL_CONFIRM_NODL, true, $gold_shortcodes);
        }
        $gold_text .= '
</form>
 ';
    }
}
$ns->tablerender($title, $gold_text);
require_once(FOOTERF);

?>