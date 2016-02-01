
$(document).ready(function(){
	// console.log($("[name='group']").parent());
	$("[name='group']").parent().click(function(){
		// window.alert('heyyy');
		var form = $('#create_book').serializeArray().reduce(function(obj, item) {
			obj[item.name] = item.value;
			return obj;
		}, {});

		if(form.group){
			$('#group_coll').collapse("show");
		}else{
			$('#group_coll').collapse("hide");
		}

	});
});
