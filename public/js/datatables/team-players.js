// Call the dataTables jQuery plugin
datatable = $('#dataTable').DataTable({
	processing: true,
	serverSide: true,
	ordering: true,
	ajax: {
        url: baseUrl + "player",
        data : function(d){
			
        d.team_id = $("#team_id").val()
        },
		error: function (error) {
			swal(error.responseJSON.message)
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
			data: 'image_uri',
			name: 'image_uri',
			"orderable": false,
			render: function (data, type, row) {
				return '<img height="100px" width="100px" src="' + assetUrl + data + '"/>';
			}
        },
        {
			data: 'country',
			name: 'country',
			render: function (data, type, row) {
				return data ? data : '-';
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
				buttons += '<a href="'+baseUrl+'player/'+ btoa(row.id)+'/edit" title="Edit player"><i class="fas fa-edit text-primary"></i></a>';
				buttons += '<span class="delete_item"  data-url="' + baseUrl + 'player/' + btoa(row.id) + '" title="Delete player"><i class="fas fa-trash text-danger"></i></span>';

				return buttons;
			}
		}
	],
});
