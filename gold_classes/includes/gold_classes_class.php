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
class goldclasses
{
    function goldclasses()
    {
        global $GOLD_CLASSPREF, $pref, $tp, $gold_sql;
        // get all the user's details
        $this->load_prefs();

        if (file_exists(e_THEME . 'gold_classes_template.php'))
        {
            define(GOLD_CLASS_THEME, e_THEME . 'gold_classes_template.php');
        }
        else
        {
            define(GOLD_CLASS_THEME, e_PLUGIN . 'gold_classes/templates/gold_classes_template.php');
        }
    }
    // ********************************************************************************************
    // *
    // * Gold Classes Load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $GOLD_CLASSPREF;
        $GOLD_CLASSPREF = array('gold_classes' => '');
    }

    function save_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_CLASSPREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($GOLD_CLASSPREF);
        $sql->db_Update('core', "e107_value='$tmp' where e107_name='plugin_gold_classes'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_CLASSPREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select('core', '*', "e107_name='plugin_gold_classes' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($GOLD_CLASSPREF);
            $sql->db_Insert('core', "'gold_classes', '$tmp' ");
            $sql->db_Select('core', '*', "e107_name='plugin_gold_classes' ");
        }
        else
        {
            $GOLD_CLASSPREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
}
