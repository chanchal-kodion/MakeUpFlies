$(document).ready (function(){
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/check-current-password',
            data:{current_password:current_password},
            success:function(resp){
                if(resp=="false"){
                    $('#verify_current_password').html("Current pasword is incorrect");
                }else if(resp=="true"){
                    $('#verify_current_password').html("Current pasword is correct");
                }
            },
            error:function(){
                alert('error');
            }
        });
    });

    // update cms page
    $(document).ready(function() {
        $(document).on("click", ".updateCmsPageStatus", function() {
            var status = $(this).children("i").attr('status');
            var page_id = $(this).attr('page_id');
    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-cms-page-status',
                data: { status: status, page_id: page_id },
                success: function(resp) {
                    console.log(resp['status']);
                    if (resp['status'] == 0) {
                        $("#page-" + page_id).html("<i class='fas fa-toggle-off' style='color: grey;' status='Inactive'></i>")
                    } else if (resp['status'] == 1) {
                        $("#page-" + page_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
                    }
                },
                error: function() {
                    alert("Error occurred during the AJAX request.");
                }
            });
        });
    });

    // update subadmin page
    $(document).ready(function() {
        $(document).on("click", ".updateSubadminStatus", function() {
            var status = $(this).children("i").attr('status');
            var subadmin_id = $(this).attr('subadmin_id');
    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-subadmin-status',
                data: { status: status, subadmin_id: subadmin_id },
                success: function(resp) {
                    console.log(resp['status']);
                    if (resp['status'] == 0) {
                        $("#subadmin-" + subadmin_id).html("<i class='fas fa-toggle-off' style='color: grey;' status='Inactive'></i>")
                    } else if (resp['status'] == 1) {
                        $("#subadmin-" + subadmin_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
                    }
                },
                error: function() {
                    alert("Error occurred during the AJAX request.");
                }
            });
        });
    });

    // update category page
    $(document).ready(function() {
        $(document).on("click", ".updateCategoryStatus" , function() {
            var status = $(this).children("i").attr('status');
            var category_id = $(this).attr('category_id');
    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-category-status',
                data: { status: status, category_id: category_id },
                success: function(resp) {
                    console.log(resp['status']);
                    if (resp['status'] == 0) {
                        $("#category-" + category_id).html("<i class='fas fa-toggle-off' style='color: grey;' status='Inactive'></i>")
                    } else if (resp['status'] == 1) {
                        $("#category-" + category_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
                    }
                },
                error: function() {
                    alert("Error occurred during the AJAX request.");
                }
            });
        });
    });

    // update product page
    $(document).ready(function() {
        $(document).on("click", ".updateProductStatus" , function() {
            var status = $(this).children("i").attr('status');
            var product_id = $(this).attr('product_id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-product-status',
                data: { status: status, product_id: product_id },
                success: function(resp) {
                    console.log(resp['status']);
                    if (resp['status'] == 0) {
                        $("#product-" + product_id).html("<i class='fas fa-toggle-off' style='color: grey;' status='Inactive'></i>")
                    } else if (resp['status'] == 1) {
                        $("#product-" + product_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
                    }
                },
                error: function() {
                    alert("Error occurred during the AJAX request.");
                }
            });
        });
    });
    
});


function addtocart(id){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'add-to-cart',
        type:'post',
        data:{id:id},
        dataType:'json',
        success: function(response){
            if(response.status == true){
                // window.location.href= "cart";
                alert("product added successfully!");
            }else{
                alert(response.message);
            }
        }
    });
}