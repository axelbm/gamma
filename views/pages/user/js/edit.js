if(phpvar.user_edit_tab){
	$('.nav-tabs a[href="#tab_'+phpvar.user_edit_tab+'"]').tab('show');
}else{
	$('.nav-tabs a[href="#tab_profil').tab('show');
}

if(phpvar.delete_account_modal == true){
	$("#delete_account").modal("show");
}
