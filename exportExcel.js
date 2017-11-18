$(document).ready(function() {
	$('#adsTable').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'excel', 'csv'
		]
	} );
} );