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
class gold_shop
{
    function gold_shop()
    {
        global $GOLD_SHOP_PREF, $pref, $tp, $gold_sql;
        // get all the details
        $this->load_prefs();
    }
    // ********************************************************************************************
    // *
    // * Gold Shop Load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $GOLD_SHOP_PREF;

        $GOLD_SHOP_PREF = array('gold_shop_shops' => '');
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_SHOP_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($GOLD_SHOP_PREF);
        $sql->db_Update('core', "e107_value='$tmp' where e107_name='plugin_gold_shop'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_SHOP_PREF;
        // get preferences from database
        $sql = e107::getDb();
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->select('core', '*', "e107_name='plugin_gold_shop' ");
        $row = $sql->db_Fetch();
				print_a($num_rows);
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($GOLD_SHOP_PREF);
            $sql->db_Insert('core', "'plugin_gold_shop', '$tmp' ");
            $sql->db_Select('core', '*', "e107_name='plugin_gold_shop' ");
        }
        else
        {
            $GOLD_SHOP_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
}
