// Call the dataTables jQuery plugin
$(document).ready(function () {
	$('#dataTable').DataTable({
		processing: true,
		serverSide: true,
		ordering: true,
		ajax: {
			url: window.location.href,
			data: function (d) {

			},
			error: function (error) {
				window.location.href = baseUrl
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
				"width": '5%',
				render: function (data, type, row) {
					return '<a class="td-text-wrap" href="' + baseUrl + 'user/' + btoa(row.id) + '">' + data + '</a > ';
				}
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
					buttons += '<a href="" title="Add Team"><i class="fas fa-edit text-primary"></i></a>';
					buttons += '<a class="delete_item" title="Delete Team"><i class="fas fa-trash text-danger"></i></a>';

					return buttons;
				}
			}
		],
	});
});
