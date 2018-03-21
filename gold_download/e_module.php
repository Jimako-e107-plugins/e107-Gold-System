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
if (!defined('e107_INIT'))
{
    exit;
}

global $GOLD_PREF, $gold_obj,$gold_dl_obj;

include_lan(e_PLUGIN . 'gold_download/languages/' . e_LANGUAGE . '.php');
require_once(e_HANDLER . 'userclass_class.php');

if (!is_object($gold_obj))
{
    require_once(e_PLUGIN. 'gold_system/includes/gold_class.php');
    if (!is_object($gold_obj))
    {
        $gold_obj = new gold;
    }
}
if (!is_object($gold_dl_obj))
{
    require_once(e_PLUGIN. 'gold_download/includes/gold_download_class.php');
    if (!is_object($gold_dl_obj))
    {
        $gold_dl_obj = new gold_dl;
    }
}                                
	$eUrl = e_url::instance();
	$eUrl->run();

 /* fix for sef url */
if($gold_obj->plugin_active('gold_download')) {
   if ((e_PAGE == 'request.php' && strpos(e_QUERY,'download.')===false)
   OR
   ( 
   strpos(e_REQUEST_URI,'/download/get/') !== false
   ))
  //if ( $gold_obj->plugin_active('gold_download')  )
  {
     
      session_start();
      $gold_tmp = explode('?', $_SESSION['gold_dl']);
      if ($_SESSION['gold_dl'] === 0 || e_QUERY != $gold_tmp[1])
      {
    
          // not got an OK for download
          // go and display query page
          header('Location:' . e_PLUGIN_ABS . 'gold_download/gold_dl.php?' . $_GET['id']);
          exit;
      }
      else
      {
          session_start();
          $tmp =  explode("=", e_QUERY);
          //$gold_request = $tp->toDB(e_QUERY);
          $gold_request = $tmp[1];
          $_SESSION['gold_dl'] = 0;
          // we have got the OK
          $gold_balance = $gold_obj->gold_balance(USERID);               
          $gold_dllist = unserialize($GOLD_DL_PREF['gold_dlclasses']);
          if (count($gold_dllist > 0))
          {
              $gold_ulist = explode(',', USERCLASS_LIST);
              $gold_dlbalance = $gold_obj->gold_balance(USERID);
              $gold_charge = 999999999;
              foreach($gold_dllist as $gold_row)
              {
                  $gold_class = $gold_row['gold_dl_class'];
                  $gold_cost = $gold_row['gold_dl_cost'];
                  // print "$gold_class $gold_cost<br>";
                  if (in_array($gold_class, $gold_ulist))
                  {
                      $gold_charge = min($gold_charge, $gold_cost);
                  }
              }
          }
          $gold_sql->select('download', 'download_id,download_name', 'where download_id="' . $gold_request . '" or download_url="'. $gold_request . '" or download_name="' . $gold_request . '"', 'nowhere', true, true);
          
          extract($gold_sql->fetch());
   
          if ($gold_balance >= $gold_charge)
          {
              $gold_param = array('gold_user_id' => USERID,
                  'gold_who_id' => 0,
                  'gold_amount' => $gold_charge,
                  'gold_plugin' => 'gold_download',
                  'gold_type' => GOLD_DL_DLC09,
                  'gold_action' => 'debit',
                  'gold_log' => GOLD_DL_DLC12 . ' : ' . $download_name);
                  
              
              $gold_obj->gold_modify($gold_param, true);
          }
          else
          {
              // insufficient funds
              $site = SITEURL . "index.php";
              $alert = GOLD_DL_DLC11 . ' ' . $GOLD_PREF['gold_currency_name'] . ' ' . GOLD_DL_DLC10;
              echo "<script>alert('{$alert}'); document.location = '{$site}';</script>";
              exit;
          }
   
      }
      return;
  }
}
?>