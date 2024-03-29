
global $sql, $gasset, $PLUGINS_DIRECTORY,$tp;
// Parameter 1 - userid
// parameter 2 - order
// parameter 3 - size (64,32,16 px)
// parameter 4 - assets per row
// parameter 5 - number to show

$gasset_parmlist = explode(',', $parm);
// print_a($gasset_parmlist);
if (intval($gasset_parmlist[0]) == 0)
{
    $gasset_userid = USERID;
}
else
{
    $gasset_userid = intval($gasset_parmlist[0]);
}
include_lan(e_PLUGIN . "gold_asset/languages/" . e_LANGUAGE . "_goldasset.php");
//if (e_PAGE == 'user.php')
if (e_PAGE == 'user.php' OR strpos(e_REQUEST_URI,'/user/') !== false )
{
    // if the page is the user display page then get the user's id
    // and read in all the assets
    $tmp = explode('.', e_QUERY);
    $gasset_userid = intval($tmp[1]);
    require_once(e_HANDLER . 'file_class.php');
    $gasset_fclass = new e_file;
    $gasset_omit = array('^\.$', '^\.\.$', '^\/$', '^CVS$', 'thumbs\.db', '.*\._$', '^\.htaccess$', 'index\.html', 'null\.txt', '\.LCK');
    // scan the asset directories for all assets
    $gasset_list = $gasset_fclass->get_files(e_PLUGIN . 'gold_asset/assets/', 'asset.php', $gasset_omit, 1);

    foreach($gasset_list as $gasset_assetmain)
    {

        require($gasset_assetmain['path'] . '/' . $gasset_assetmain['fname']);
    }
}
require_once(e_HANDLER . 'date_handler.php');
$gasset_conv = new CONVERT;
if(intval($gasset_parmlist[1])==0)
{
	$grasset_initial = 0;
}
else
{
	$grasset_initial = intval($gasset_parmlist[1])-1;
}
switch (intval($gasset_parmlist[2]))
{
    case 16:
        $gasset_icon = 'icon_16';
        break;
    case 64:
        $gasset_icon = 'icon_64';
        break;
    default:
        $gasset_icon = 'icon_32';
        break;
}
if (intval($gasset_parmlist[3]) == 0)
{
    $gasset_numrow = 10;
}
else
{
    $gasset_numrow = intval($gasset_parmlist[3]);
}
if (intval($gasset_parmlist[4]) == 0)
{
    $gasset_quant = 32768;
}
else
{
    $gasset_quant = intval($gasset_parmlist[4]);
}
// print $gasset_icon.'<br />';
$gasset_arg = 'select * from #gold_asset where gasset_user_id='.$gasset_userid.' order by gasset_bought desc limit ' . $grasset_initial.','.$gasset_quant ;
if($sql->db_Select_gen($gasset_arg, false))
{

	$gasset_count = 0;
	$gasset_list='';
	while ($gasset_row = $sql->db_Fetch())
	{
	    $gasset_count++;
	    $gasset_asset = $gasset_row['gasset_asset'];
	    if(!empty($gasset_asset) && is_readable(e_PLUGIN.'gold_asset/assets/'.$gasset_asset.'/asset.php') )
		{

			require(e_PLUGIN.'gold_asset/assets/'.$gasset_asset.'/asset.php');
	    	$gasset_imagesrc = SITEURL . $PLUGINS_DIRECTORY . 'gold_asset/assets/' . $gasset_asset . '/' . $gasset[$gasset_asset][$gasset_icon];
	    	$gasset_title = '<b>' . $tp->toJS($gasset[$gasset_asset]['title']) . '</b><br />' . $tp->toJS($gasset[$gasset_asset]['description']);
	    	if ($gasset_userid == USERID)
	    	{
		        // users looking at own
		        $gasset_title .= '<br /><br /><i>' . $tp->toJS($gasset_row['user_name']) . ' ' . GOLD_ASSET_129 . ' ' . $gasset_conv->convert_date($gasset_row['gasset_bought'], 'short') . '</i>';
		    }
		    $gasset_list .= '<span class="tooltip_text"  onmousemove="showToolTip(event,\''.$gasset_title.'\');return false" onmouseout="hideToolTip()"><img src="'.$gasset_imagesrc.'" style="border:0px" alt="" title="" />&nbsp;</span>';
		    if ($gasset_count >= $gasset_numrow)
		    {
		        $gasset_count = 0;
		        $gasset_list .= '<br />';
		    }
	    }
	}
	return $gasset_list;
}
else
{
	return '';
}