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
class gold_dl
{
    function gold_dl()
    {
        global $GOLD_DL_PREF;
        $this->load_prefs();

    }
    // ********************************************************************************************
    // *
    // * Gold Download Load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $GOLD_DL_PREF;
        $GOLD_DL_PREF = array('gold_dlclasses' => '');
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_DL_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($GOLD_DL_PREF);
        $sql->db_Update('core', "e107_value='$tmp' where e107_name='plugin_gold_download'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_DL_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select('core', '*', "e107_name='plugin_gold_download' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($GOLD_DL_PREF);
            $sql->db_Insert('core', "'gold_download', '$tmp' ");
            $sql->db_Select('core', '*', "e107_name='plugin_gold_download' ");
        }
        else
        {
            $GOLD_DL_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
}
