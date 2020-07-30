// Call the dataTables jQuery plugin
datatable = $('#dataTable').DataTable({
	processing: true,
	serverSide: true,
	ordering: true,
	ajax: {
		url: window.location.href,
		error: function (error) {
			swal({error})
		},
	},
	order: [
		[4, 'desc']
	],
	columns: [
		{
			data: 'rownum',
			name: 'rownum',
			orderable: false
		},
		{
			data: 'name',
			name: 'name',
		},
		{
			data: 'club_state',
			name: 'club_state',
			render: function (data, type, row) {
				return data ? data : '-';
			}
		},
		{
			data: 'logo_uri',
			name: 'logo_uri',
			"orderable": false,
			render: function (data, type, row) {
				return '<img height="100px" width="100px" src="' + assetUrl + data + '"/>';
			}
		},
		{
			data: 'created_at',
			name: 'created_at',
			render: function (data, type, row) {
				return row.format_created_at ? row.format_created_at : '-';
			}
		},
		{
			data: "",
			"orderable": false,
			"render": function (data, type, row) {
				var buttons = "";
				buttons += '<a href="'+baseUrl+'team/'+ btoa(row.id)+'/edit" title="Add Team"><i class="fas fa-edit text-primary"></i></a>';
				buttons += '<span class="delete_item"  data-url="' + baseUrl + 'team/' + btoa(row.id) + '" title="Delete Team"><i class="fas fa-trash text-danger"></i></span>';

				return buttons;
			}
		}
	],
});
