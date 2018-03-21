<?php
// get the language file
include_lan(e_PLUGIN . 'gold_download/languages/' . e_LANGUAGE . '.php');
$e_gold[] = array('plug_name' => 'Gold Download',
    'plug_folder' => 'gold_download',
    'add' => false,
    'deduct' => true,
    'gold_menu' => true,
    'gold_link' => SITEURL.'download.php',
    'gold_title' => 'Downloads');

if (!function_exists('gold_download_configure_edit'))
{
    function gold_download_configure_edit()
    {
        return 'Configuration in plugin';
    }
}
if (!function_exists('gold_download_configure_save'))
{
    function gold_download_configure_save()
    {
    }
}

?>