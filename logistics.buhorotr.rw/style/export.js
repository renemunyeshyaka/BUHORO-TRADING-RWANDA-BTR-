$( document ).ready(function() {
	$(".dataExport").click(function() {
		var exportType = $(this).data('type');		
		$('#dataTable').tableExport({
			type : exportType,			
			escape : 'false',
			ignoreColumn: []
		});		
	});
});
