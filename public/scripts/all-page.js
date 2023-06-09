$(document).ready(function () {

    setProfile();

    function setProfile() {
        $.ajax({
            url: '/setprofile',
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    $('#profile_photo').attr('src', `storage/${response.profile_photo[0]}`);
                    // console.log(response.profile_photo[0]);
                }
            },
        })
    }

    $(document).on('click', '.likeBlog', function () {
        let blog_id = $(this).attr('id');
        let id = blog_id.substring(4, blog_id.length);
        console.log(id);
        $.ajax({
            url: '/setlike',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",
            data:{id:id},
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    $(`#like${id}`).addClass(`bg-light-danger btn-text-danger`);
                    $(`#like${id}`).removeClass('likeBlog');
                    $(`#${id}total`).text(`${response.data}`);
                }
            },
        })
       
    })

    $(document).on('click','.bg-light-danger.btn-text-danger',function(){
        let blog_id = $(this).attr('id');
        let id = blog_id.substring(4, blog_id.length);
        console.log(id);
        $.ajax({
            url: '/dislike-blog',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",
            data:{id:id},
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    $(`#like${id}`).removeClass(`bg-light-danger btn-text-danger`);
                    $(`#like${id}`).addClass('likeBlog');
                    $(`#${id}total`).text(`${response.data}`);
                }
            },
        })
    });

    $(document).on('click','.label-success',function(e){
        let user_id = $(this).attr('id');
        let id = user_id.substring(6, user_id.length);
        console.log(id);
        
            $.ajax({
                url: '/unfollow-user',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                data:{id:id},
                dataType: "json",
                success: function (response) {
                    if (response.status == 'success') {
                        $(`#follow${id}`).removeClass('label-success').addClass(`label-info follow`);
                        $('.total-followers').text(`${response.data} Followers`)
                        $(`#follow${id}`).text(`+ Follow`);
                    }   
                },
            })
    });

    $(document).on('click','.follow',function(e){
        let user_id = $(this).attr('id');
        let id = user_id.substring(6, user_id.length);
        console.log(id);
        
            $.ajax({
                url: '/followuser',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                data:{id:id},
                dataType: "json",
                success: function (response) {
                    if (response.status == 'success') {
                        $(`#follow${id}`).removeClass('label-info follow').addClass(`label-success`);
                        $('.total-followers').text(`${response.data} Followers`)
                        $(`#follow${id}`).text(`Following`);
                    }
                },
            })
        
       
    })

    $(document).on('click','#rateUser',function(e){
        e.preventDefault();
        let formData = $('#rating_form').serialize();
        console.log(formData);

        $.ajax({
            url: '/rateuser',
            
            type: "POST",
            data:formData,
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    $('#rating').prop('selectedIndex',0);
                    console.log(response.data);
                    let star = Math.floor(response.data);
                    $('#user_rating').html('');
                    for(i=1;i<=star;i++){
                        let rating = `<div  class="d-flex flex-row  my-5">
                        <div class="fa-item col-md-3 col-sm-4">
                          <i class="fa fa-star" style="color:#F7D060;"></i></div>                         
                        </div>`

                        $('#user_rating').append( `${rating}`);
                    }
                    
                    // $(`#like${id}`).addClass(`bg-light-danger btn-text-danger`);
                    // $(`#${id}total`).text(`${response.data}`);
                }
            },
        })
    })

    function showBlog(blog_id){
        let id = blog_id.substring(7, blog_id.length);
        console.log(id);
        window.location.href = `/singleblog/${id}`
    }
    
    $(document).on('click','.singleBlog',function(){
        let blog_id = $(this).attr('id');
        showBlog(blog_id);
        // $.ajax({
        //     url: '/singleblog',
        //     type: "GET",
        //     data:{id:id},
        //     dataType: 'html',
        //     success: function (response) {
        //         console.log('inside single blog');
        //        return;
        //     },
        // })
    })

    $(document).on('click','.commentBlog',function(){
        let blog_id = $(this).attr('id');
        showBlog(blog_id);
    })

    $(document).on('click','.readMore',function(){
        let blog_id = $(this).attr('id');
        showBlog(blog_id);
    });

   

    //blog ckeditor
    var template_ckeditor = {
        ckeditor: () => {

            var csrf_token = $('meta[name="csrf-token"]').attr("content");
            ClassicEditor.create(document.querySelector("#content"), {
                    ckfinder: {
                        uploadUrl: `/upload?_token=${csrf_token}`,
                    },
                })
                .then((editor) => {

                    console.log(editor);
                    // editor.setData(email_content);

                })
                .catch((error) => {

                });
        },

        ckeditor2: (blog_content) => {
            var content;
            var csrf_token = $('meta[name="csrf-token"]').attr("content");
            ClassicEditor.create(document.querySelector("#blogContent"), {
                    ckfinder: {
                        uploadUrl: `/upload?_token=${csrf_token}`,
                    },
                })
                .then((editor) => {
                    console.log(editor);
                    // editor.;
                    editor.setData(blog_content);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    };

    //tag selector
    var tags_select2 = {
        tags: () => {
            // multi select
            $("#kt_select2_3,#kt_edit_select2_3, #kt_select2_3_validate").select2({
                placeholder: "Select a Customer",
                allowClear: true
            });
        },
    };
    template_ckeditor.ckeditor();
    tags_select2.tags();

    // add blog
    $(document).on('submit', '#addBlogForm', function (e) {

        e.preventDefault();
        var formData = new FormData(this);

        var title = formData.get('title');
        console.log(title);
        var content = formData.get('content');
        var selected = [];
        $('#kt_select2_3 :selected').each(function (i) {
            // selected[$(this).val()] = $(this).text();
            selected.push($(this).val())
            // formData.append(`tag${i}`,$(this).text());
        });
        formData.append(`tags`, selected);

        $.ajax({
            url: "/addblog",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,

            dataType: "json",
            success: function (response) {
                // alert(response.status);
                if (response.status == "success") {

                    toastr.success(`${response.data}`);
                    $(document).find('.nav-tabs.nav-tabs-line').children().find('a').removeClass('active');
                    $(document).find('.nav-tabs.nav-tabs-line').children().first().find('a').addClass('active');
                    $('#myTabContent').children().removeClass('active show');
                    $('#kt_tab_pane_1').addClass('active show');
                    window.location.reload();
                }
            },
        })
    })

    $(document).find('.nav-tabs.nav-tabs-line').children().find('.editBlogTab').hide();

    $(document).on('click', '.editBlog', function () {
        $(document).find('.nav-tabs.nav-tabs-line').children().find('.editBlogTab').show();
        let edit_id = $(this).attr('id');
        let id = edit_id.substring(8, edit_id.length);
        console.log(id);
        $(document).find('.nav-tabs.nav-tabs-line').children().find('a').removeClass('active');
        $(document).find('.nav-tabs.nav-tabs-line').children().find('.editBlogTab').addClass('active');
        $('#myTabContent').children().removeClass('active show');
        $('#kt_tab_pane_3').addClass('active show');
        $.ajax({
            url: `/blog/edit/${id}`,
            type: "GET",
            data: {
                id: id
            },
            dataType: "json",
            success: function (response) {
                $('#blog_id').val(`${id}`);
                $("#blogTitle").val(`${response.data.title}`);
                // $("#blogContent").val(`${response.content}`);
                $("#updateBlogForm").find(".ck-editor").remove();
                template_ckeditor.ckeditor2(
                    response.data.content
                );
                // $("#kt_edit_select2_3").val(`php`);
                $("#bgImage").css(
                    "background-image",
                    `url('/storage/${response.data.image}')`
                );
                var values = response.data.tags;
                $.each(values.split(","), function (i, e) {
                    $("#kt_edit_select2_3 option[value='" + e + "']").prop("selected", true);
                });
            }
        })
    })

    $(document).on('submit', '#updateBlogForm', function (e) {

        e.preventDefault();
        var formData = new FormData(this);

        var title = formData.get('title');
        console.log(title);
        var content = formData.get('content');
        var selected = [];
        $('#kt_edit_select2_3 :selected').each(function (i) {
            // selected[$(this).val()] = $(this).text();
            selected.push($(this).val())
            // formData.append(`tag${i}`,$(this).text());
        });
        formData.append(`tags`, selected);

        $.ajax({
            url: "/updateblog",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",

            contentType: false,
            processData: false,
            data: formData,

            dataType: "json",
            success: function (response) {
                // alert(response.status);
                if (response.status == "success") {

                    toastr.success(`${response.data}`);

                    $(document).find('.nav-tabs.nav-tabs-line').children().find('a').removeClass('active');
                    $(document).find('.nav-tabs.nav-tabs-line').children().first().find('a').addClass('active');
                    $('#myTabContent').children().removeClass('active show');
                    $('#kt_tab_pane_1').addClass('active show');
                    $(document).find('.nav-tabs.nav-tabs-line').children().find('.editBlogTab').hide();
                    window.location.reload();
                }
            },
        })
    })

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
