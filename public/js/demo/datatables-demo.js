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
        render: function (data, type, row) {
          return '<img src="'+assetUrl+data+'"/>';
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
            buttons += '<span class="action_btn trash"><i data-url="' + baseUrl + 'user/' + row.id + '" data-request="change-status" data-status="' +"sdfs" + '" data-title="Are you sure, you want to in-activate this user?" class="fa fa-close" title="Inactive" aria-hidden="true"></i></span>';

          return buttons;
        }
      }
    ],
  });
});
