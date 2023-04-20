$(document).ready(function () {
    console.log('inside single blog');
    const queryString = window.location.pathname;
    console.log("queryString - ", queryString);

    var pathArray = window.location.pathname.split("/");

    var blog_id = pathArray[2];
    console.log(blog_id);

    var comment_datatable = {
        table: () => {
            var datatable = $("#kt_comments_datatable").KTDatatable({
                // datasource definition
                rows: {
                    beforeTemplate: function (raw, data, index) {
                        var page = datatable.getCurrentPage();
                        var length = datatable.getPageSize();
                        var serial = (page * length) - (length - 1) + (index);
                        $("td:eq(0)", raw).html(`<span width='80px'>${serial}</span>`);
                    },

                },

                data: {
                    type: "remote",

                    source: {
                        read: {
                            url: "/userpendingtasklist",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            map: function (raw) {
                                // sample data mapping
                                var dataSet = raw;
                                if (typeof raw.data !== "undefined") {
                                    dataSet = raw.data;
                                }

                                return dataSet;
                            },
                        },
                    },
                    pageSize: 5,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                // layout definition
                layout: {
                    scroll: false,
                    footer: false,
                },

                // column sorting
                sortable: false,

                pagination: true,



                // columns definition
                columns: [{
                        field: "id",
                        title: " No",
                        sortable: false,
                        width: 100,
                        type: "number",
                        selector: false,
                        textAlign: "center",

                    },
                    {
                        field: "title",
                        title: "Blog Name",
                        width: 250,
                        type: "number",
                        textAlign: "center",
                    },
                    {
                        field: "text",
                        title: "Comment",
                        sortable: "asc",
                        width: 250,
                        type: "number",
                        selector: false,
                        // textAlign: "center",
                    },
                    {
                        field: 'status',
                        title: 'Status',
                        // callback function support for column rendering
                        template: function (row) {
                            var status = {
                                1: {
                                    'title': 'Active',
                                    'class': 'checked'
                                },
                                0: {
                                    'title': 'Inactive',
                                    'class': ' '
                                },
                            };
                            // return '<span class="label font-weight-bold label-lg ' + status[row.is_active].class + ' label-inline">' + status[row.is_active].title + '</span>';
                            return `
                            <div class="col-3">
                                <span class="switch switch-primary">
                                    <label>
                                        <input id='comment${row.id}' class='approve-class' ${row.status == 1 ? 'checked' : ''} type="checkbox"  value='${row.status}' name="select"/>
                                        <span></span>
                                    </label>
                                </span>
                            </div>`;
                        },
                    },

                ],
            });
        },
    };
    comment_datatable.table();
    $("#addComment").on("click", function (e) {
        // alert('add comment clicked');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        e.preventDefault();

        let comment_text = $("#oneComment").val();
        // alert(comment_text);
        if (comment_text == "") {
            alert("Please write something comment field is blank");
        } else {
            console.log(comment_text);
            $("#oneComment").val("");
            let blog_owner_id = $('#blog_owner_id').val();
            console.log(blog_owner_id);
            $.ajax({
                url: `/blog/comment/${blog_id}`,
                method: "POST",
                data: {
                    comment: comment_text,
                    blog_owner_id: blog_owner_id
                },
                dataType: "json",
                success: function (response) {
                    toastr.success(`${response.data}`)
                },
            });
        }
    });

    $(document).on('click', '.approve-class', function () {
        let comment_id = $(this).attr('id');
        let id = comment_id.substring(7, comment_id.length);
        console.log(id);

        let status = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: '/commentapprove',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: 'POST',
            data: {
                status: status,
                id: id
            },
            dataType: 'json',
            success: function (response) {
                if (response.status == 'success') {
                    $("#kt_comments_datatable").KTDatatable('reload');
                    toastr.success(`${response.data}`)
                } else {
                    toastr.error(`${response.data}`);
                }
            }
        })
    })

    $(document).on('click','#rateBlog',function(e){
        e.preventDefault();
        let formData = $('#blog_rating_form').serialize();
        console.log(formData);

        $.ajax({
            url: '/rateblog',
            
            type: "POST",
            data:formData,
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    $('#rating').prop('selectedIndex',0);
                    console.log(response.data);
                    let star = Math.floor(response.data);
                    $('#blog_rating').html('');
                    for(i=1;i<=star;i++){
                        let rating = `<div  class="d-flex flex-row  my-5">
                        <div class="fa-item col-md-3 col-sm-4">
                          <i class="fa fa-star"></i></div>                         
                        </div>`

                        $('#blog_rating').append( `${rating}`);
                    }
                    
                    // $(`#like${id}`).addClass(`bg-light-danger btn-text-danger`);
                    // $(`#${id}total`).text(`${response.data}`);
                }
            },
        })
    })
})
