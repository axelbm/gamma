
$(document).ready(function(){
	var active_item;

	if(phpvar.page_add_tab){
		$('#'+phpvar.page_add_tab).tab("show")
	}else{
		$('#nav_retake').tab("show")
	}

	$('#action_nav a').on('shown.bs.tab', function(event){
		$("#action_input").attr('value', $(this).attr("id"));
	});

	$("#page_list > .list-group-item").click(function(){
		if(active_item){
			$("#page_list > .list-group-item").children('.collapse').collapse("hide");
			$("#page_list > .list-group-item").removeClass("active");
		}

		console.log($(this).attr("id"));
		$(this).addClass("active");
		$(this).children('.collapse').collapse("show");

		$("#page_input").attr('value', $(this).attr("id"));

		active_item = $(this);
	});

	if(phpvar.page_select){
		$('#'+phpvar.page_select).click();
	}
});