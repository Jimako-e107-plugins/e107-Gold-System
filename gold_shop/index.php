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
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}

include_lan(e_PLUGIN . "gold_shop/languages/" . e_LANGUAGE . "_gold_shop.php");

if (!is_object($gold_obj))
{
    require_once(e_PLUGIN . 'gold_system/includes/gold_class.php');
    $gold_obj = new gold;
}
if (!$gold_obj->plugin_active('gold_shop'))
{
    require_once(HEADERF);
    print GOLD_SHOP_04;
    require_once(FOOTERF);
    exit;
}

require_once(e_HANDLER . 'userclass_class.php');

if (!is_object($gshop_obj))
{
    require_once(e_PLUGIN . 'gold_shop/includes/gold_shop_class.php');
    $gshop_obj = new gold_shop;
}
if (file_exists(THEME . '/images/gold_shop_logo.png'))
{
    define(GSHOP_LOGO, THEME . '/images/gold_shop_logo.png');
} elseif (file_exists(e_PLUGIN . 'gold_shop/images/gold_shop_logo.png'))
{
    define(GSHOP_LOGO, e_PLUGIN . 'gold_shop/images/gold_shop_logo.png');
}
require_once(HEADERF);

if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, 'width:100%;');
}
if (file_exists(THEME . 'gold_shop_template.php'))
{
    define(GORB_THEME, THEME . 'gold_shop_template.php');
}
else
{
    define(GORB_THEME, e_PLUGIN . 'gold_shop/templates/gold_shop_template.php');
}
require_once(GORB_THEME);

require_once(e_PLUGIN . 'gold_shop/includes/gold_shop_shortcodes.php');

unset($gshop_data);
$gshop_data = $GOLD_SHOP_PREF['gold_shop_show'];
$gshop_text = $tp->parsetemplate($GOLD_SHOP_HEADER, true, $gshop_shortcodes);

foreach($gshop_data as $value)
{
   # print "$value<br>";
    if (file_exists(e_PLUGIN . $value . '/e_gold.php'))
    {
        require(e_PLUGIN . $value . '/e_gold.php');
    }
}

if (count($e_gold) == 0)
{
    $gshop_text .= $tp->parsetemplate($GOLD_SHOP_NODETAIL, true, $gshop_shortcodes);
}
else
{
    foreach($e_gold as $value)
    {
        $gold_shop_title = $value['gold_shop_title'];
        $gold_shop_name = $value['gold_shop_name'];
        $gold_shop_url = $value['gold_shop_url'];
        $gold_shop_icon = $value['gold_shop_icon'];
        $gold_shop_desc = $value['gold_shop_desc'];
        $gshop_text .= $tp->parsetemplate($GOLD_SHOP_DETAIL, true, $gshop_shortcodes);
    }
}
$gshop_text .= $tp->parsetemplate($GOLD_SHOP_FOOTER, true, $gshop_shortcodes);
$ns->tablerender(GOLD_SHOP_03, $gshop_text);
require_once(FOOTERF);
