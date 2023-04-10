$(document).ready(function(){

    $('#myprofile_form').on('submit',function(e){
        e.preventDefault();
        let formData = new FormData(this);
        console.log(formData.get("mobileno"));
        console.log(formData.get("id")); 

        $.ajax({
            url: '/myprofileupdate',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function (response) {
                if(response.status == 'success'){

                    $('#profile_photo').attr('src',`storage/${response.profile_photo}`);
                    window.location.href = '/home';
                }
            },
        });
    })

   
})