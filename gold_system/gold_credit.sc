global $gold_sc_userid,$gold_obj,$user;
// Uses a parameter containing the user id
// or a variable called $gold_sc_userid containing the user ID
// or a variable called $user with an element ['user_id'] containing the user ID
if(isset($gold_obj))
{
	if ($parm > 0)
	{
		return $gold_obj->formation($gold_obj->gold_received($parm));
	}
	elseif ($gold_sc_userid>0)
	{
		return $gold_obj->formation($gold_obj->gold_received($gold_sc_userid));
	}
	elseif($user['user_id']>0)
	{
		return $gold_obj->formation($gold_obj->gold_received($user['user_id']));
	}
	else
	{
		return '';
	}
}
else
{
	return "";
}