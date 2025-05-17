$('#commanform').on('submit', function (e) {
    e.preventDefault();
    $('.error').html(" ");
    $('.text-danger').html(" ");
    $('#commanButton').html("Please wait...");

    const submiturl = $('#commanform').attr("action");
    const method = $('#commanform').attr("method");
    const formData = $('#commanform').serialize();

    $.ajax({
        url: submiturl,
        method: method,
        data: formData,
        success: function (result) {
            $('#commanButton').html("Submit");

            // SweetAlert Success Popup
            Swal.fire({
                title: 'Success!',
                text: result.message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = window.location.href;
            });
        },
        error: function (xhr, status, error) {
            $('#commanButton').html("Submit");

            if (xhr.responseJSON && xhr.responseJSON.errors) {
                Object.keys(xhr.responseJSON.errors).forEach(function (key) {
                    xhr.responseJSON.errors[key].forEach(function (value) {
                        $('#' + key + '-error').html(value);
                    });
                });
            } else {
                console.log(status, error, xhr);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});


function CommanDelete(type, table, id) {
    if (type === 'delete') {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: window.origin + '/admin/users/commandelete', // Update with your actual delete route
                    method: 'POST',
                    data: { table: table, id: id, type: type },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                
                    success: function (response) {
                        if (response.code === 200) {
                            Swal.fire("Deleted!", "Your record has been deleted.", "success");
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            Swal.fire("Error!", "Failed to delete the record.", "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error!", "Something went wrong.", "error");
                    }
                });
            }
        });
    }
}