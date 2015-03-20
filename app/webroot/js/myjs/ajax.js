var Meeting = {
	del: function(file_id, url){
		$.ajax({
			type: "GET",
			url: url,
			success: function(msg){
				$('#meeting_list_'+file_id).remove();
			}
		});
	}
}