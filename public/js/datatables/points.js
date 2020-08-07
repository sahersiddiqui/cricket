// Call the dataTables jQuery plugin
datatable = $('#dataTable').DataTable({
	processing: true,
	serverSide: true,
	ordering: true,
	ajax: {
		url: window.location.href,
		error: function (error) {
			swal(error.responseJSON.message)
		},
	},
	order: [
		[3, 'desc']
	],
	columns: [
		{
			data: 'rownum',
			name: 'rownum',
			orderable: false
		},
		{
			data: 'team.name',
            name: 'team.name',
			orderable: false,
            
		},
        {
			data: 'match',
            name: 'match',
			orderable: false,
			render: function (data, type, row) {
				return data  && data.result != "0" ? "Win" : 'Draw';
			}
		},
        {
			data: 'points',
			name: 'points',
		},
		{
			data: 'match',
            name: 'match',
			orderable: false,
        
			render: function (data, type, row) {
				return data && data.format_match_date ? data.format_match_date : '-';
			}
		}
		
	],
});
