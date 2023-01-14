$(document).ready(function () {
    $('.edit').click(function () {
        var userid = $(this).data('id');
        $.ajax({
            type: "get",
            url: "admindashboard/update",
            // datatype: "html",
            data: {
                id: userid,
            },
            success: function (data) {
                console.log(data);
                $('.data').html(data);
                $('#modal_data').modal('show');

            }
        })
    })
});
$(document).ready(function () {
    $('.delete').click(function () {
        var userid = $(this).data('id');
        $.ajax({
            type: "get",
            url: "admindashboard/delete",
            // datatype: "html",
            data: {
                id: userid,
            },
            success: function (data) {
                console.log(data);
                $('.data').html(data);
                $('#modal_data').modal('show');
                window.location.reload();

            }
        })
    })
});