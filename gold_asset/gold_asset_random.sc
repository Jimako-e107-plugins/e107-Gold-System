global $sql,$gasset,$PLUGINS_DIRECTORY,$tp,$post_info;
// Parameter 1 - userid
// parameter 2 - initial
// parameter 3 - size (64,32,16 px)

$gasset_parmlist=explode(',',$parm);
include_lan(e_PLUGIN . "gold_asset/languages/" . e_LANGUAGE . "_goldasset.php");

if(intval($gasset_parmlist[0])==0)
{
	$gasset_userid=USERID;
}
else
{
	$gasset_userid=intval($gasset_parmlist[0]);
}
if(intval($gasset_parmlist[0])==0)
{
	$grasset_initial=0;
}
else
{
	$grasset_initial=intval($gasset_parmlist[1])-1;
}
switch(intval($gasset_parmlist[2]))
{
	case 16:
		$gasset_icon='icon_16';
		break;
	case 64:
		$gasset_icon='icon_64';
		break;
	default:
		$gasset_icon='icon_32';
	break;
}
if(intval($gasset_parmlist[3])==0)
{
	$gasset_quant=1;
}
else
{
	$gasset_quant=intval($gasset_parmlist[3]);
}
//if (e_PAGE == 'user.php')
if (e_PAGE == 'user.php' OR strpos(e_REQUEST_URI,'/user/') !== false )
{
    // if the page is the user display page then get the user's id
    $tmp = explode('.', e_QUERY);
    $gasset_userid = intval($tmp[1]);
}
//if(e_PAGE=='forum_viewtopic.php')
if (e_PAGE == 'forum_viewtopic.php' OR strpos(e_REQUEST_URI,'/forum/') !== false )
{
	$gasset_userid=$post_info['user_id'];
}
require_once(e_HANDLER.'date_handler.php');
$gasset_conv=new CONVERT;
$gasset_sql=new db;
$gasset_arg='select * from #gold_asset where gasset_user_id='.$gasset_userid.' order by rand() limit 1';
if($gasset_sql->db_Select_gen($gasset_arg,false))
{
	$gasset_row=$gasset_sql->db_Fetch();
	$gasset_asset=$gasset_row['gasset_asset'];
	if(!empty($gasset_asset) && is_readable(e_PLUGIN.'gold_asset/assets/'.$gasset_asset.'/asset.php'))
	{
		require(e_PLUGIN.'gold_asset/assets/'.$gasset_asset.'/asset.php');
		$gasset_imagesrc=SITEURL.$PLUGINS_DIRECTORY.'gold_asset/assets/'.$gasset_asset.'/'.$gasset[$gasset_asset][$gasset_icon];
		$gasset_title=htmlentities('<b>'.$tp->toJS($gasset[$gasset_asset]['title']).'</b><br />'.$tp->toJS($gasset[$gasset_asset]['description']));
		if ($gasset_userid==USERID)
		{
			// users looking at own
			$gasset_title.=htmlentities('<br /><br /><i>'.GOLD_ASSET_145.' '.$gasset_conv->convert_date($gasset_row['gasset_bought'],'short').'</i>');
		}
		$retval.='<span class="tooltip_text" onmouseover="showToolTip(event,\''.$gasset_title.'\');return true" onmouseout="hideToolTip()"><img src="'.$gasset_imagesrc.'" style="border:0px" alt="'.$gasset[$gasset_asset]['title'].'" title="'.$gasset[$gasset_asset]['title'].'" />&nbsp;</span>';
	}
	else
	{
		$retval='';
	}
	return $retval;
}
else
{
	return '';
}