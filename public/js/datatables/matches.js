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
			data: 'first_team.name',
            name: 'first_team.name',
			orderable: false
            
		},
        {
			data: 'second_team.name',
            name: 'second_team.name',
			orderable: false
            
		},
        {
			data: 'format_match_date',
			name: 'match_date',
		},
		{
			data: 'format_created_at',
			name: 'created_at',
		},
		{
			data: "",
			"orderable": false,
			"render": function (data, type, row) {
				var buttons = "";
				buttons += '<a href="'+baseUrl+'player/'+ btoa(row.id)+'/edit" title="Edit player"><i class="fas fa-edit text-primary"></i></a>';
				buttons += '<span class="delete_item"  data-url="' + baseUrl + 'player/' + btoa(row.id) + '" title="Delete player"><i class="fas fa-trash text-danger"></i></span>';

				return buttons;
			}
		}
	],
});
