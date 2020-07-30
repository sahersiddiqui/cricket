$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click", ".delete_item", function () {
        var data = $(this).data();
        swal({
            title: "Are you sure?",
            text: "You want to delete this item?",
            buttons: ["Cancel", "Confirm"],
        }).then((isConfirm) => {
            if (isConfirm) {
                $.ajax({
                    url : data.url,
                    method: 'DELETE',
                    success: function (response) {
                        swal(response.message, {
                        }).then((confirm) => {
                            datatable.ajax.reload();
                        });

                    },
                    error: function (response) {
                        swal(response.message);
                    }
                });
            }
        })
    })
})