
function gold_ConfirmPurchaseGo(item,cost,go){
	if (confirm(gold_settings_confirm_pre+" - " +item + " - "+gold_settings_confirm_post +" " + cost))
	{
		document.location.href='?buy=' + go
	}
	else
	{
		return false;
	}
}