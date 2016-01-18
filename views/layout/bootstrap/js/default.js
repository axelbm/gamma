var hash = window.location.hash.substring(1);

if(hash == 'connection_modal'){
	$("#connection_modal").modal("show");
	history.pushState("", document.title, window.location.pathname + window.location.search);
}