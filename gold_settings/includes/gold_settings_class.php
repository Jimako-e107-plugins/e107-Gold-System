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
class gold_settings
{
    function gold_settings()
    {
        global $GOLD_SETTINGS_PREF, $pref, $tp, $gold_sql, $gorb_obj;
        $this->load_prefs();
    }
    // ********************************************************************************************
    // *
    // * Gold Settings Load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $tp, $GOLD_SETTINGS_PREF, $GOLD_PREF;

        $GOLD_SETTINGS_PREF = array('gset_color' => 5000,
            'gset_name' => 5000,
            'gset_signature' => 1000,
            'gset_avatar' => 1000,
            'gset_customtitle' => 1000,
            );
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_SETTINGS_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($GOLD_SETTINGS_PREF);
        $sql->db_Update('core', "e107_value='$tmp' where e107_name='plugin_gold_settings'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_SETTINGS_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select('core', '*', "e107_name='plugin_gold_settings' ");
        $row = $sql->db_Fetch();
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($GOLD_SETTINGS_PREF);
            $sql->db_Insert('core', "'plugin_gold_settings', '$tmp' ");
            $sql->db_Select('core', '*', "e107_name='plugin_gold_settings' ");
        }
        else
        {
            $GOLD_SETTINGS_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
}
