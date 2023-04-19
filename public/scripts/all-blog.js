$(document).ready(function(){
    $(document).on('click', '.deleteBlog', function () {
        
        let delete_id = $(this).attr('id');
        let id = delete_id.substring(10, delete_id.length);
    
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        }).then(function (result) {
            if (result.value) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Blog has been deleted.",
                    icon: "success",
                    // delete:$(`#${del_user_id}`).closest('tr').remove(),
                });
    
                $.ajax({
                    url: `/deleteblog/${id}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "DELETE",
                    dataType: "json",
                    success: function (response) {
                        $(`#deleteBlog${id}`).parent().parent().parent('.card-custom').remove();
                        $(`#deleteBlog${id}`).parent().parent(".card").remove();
                        if (response.status == 'success') {
                            toastr.error(`${response.data}`);
                        } else {
                            toastr.error(`${response.data}`);
                        }
                    },
                });
    
            } else if (result.dismiss === "cancel") {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your record is safe :)",
                    icon: "error",
                });
            }
        });
    })
})

