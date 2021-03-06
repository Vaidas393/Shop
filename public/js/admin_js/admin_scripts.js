// Changing admin password
$(document).ready(function(){
  // check current Password
  $("#current_pwd").keyup(function(){
    var current_pwd = $("#current_pwd").val();
    $.ajax({
      type:"post",
      url:"/admin/check-current-pwd",
      data:{current_pwd:current_pwd},
      success:function(resp){
        if(resp=='false'){
          $("#chkCurrentPswd").html("<font color=red>Current password is incorect</font>");
        }else if(resp=="true"){
            $("#chkCurrentPswd").html("<font color=green>Current password is corect</font>");
        }
    },error:function(){
      alert("e");
    }
    });
  });

  // Section status
  $(".updateSectionStatus").click(function(){
    var status = $(this).text();
    var section_id = $(this).attr("section_id");
    $.ajax({
      type:"post",
      url:"/admin/update-section-status",
      data:{status:status,section_id:section_id},
      success:function(resp){
        if(resp['status']==0){
          $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>");
        }else if(resp['status']==1){
          $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>");
        }
      },error:function(){
        alert("Error");
      }
    })
  });

  // Categories status
  $(".updateCategoryStatus").click(function(){
    var status = $(this).text();
    var category_id = $(this).attr("category_id");
    $.ajax({
      type:"post",
      url:"/admin/update-category-status",
      data:{status:status,category_id:category_id},
      success:function(resp){
        if(resp['status']==0){
          $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>");
        }else if(resp['status']==1){
          $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>");
        }
      },error:function(){
        alert("Error");
      }
    })
  });

// Append Category level
  $('#section_id').change(function(){
    var section_id = $(this).val();
    $.ajax({
      type: 'post',
      url:'/admin/append-categories-level',
      data:{section_id:section_id},
      success:function(resp){
        $("#appendCategoriesLevel").html(resp);
      },error:function(){
        alert("Error");
      }
    });
  });

  // Product status
  $(".updateProductStatus").click(function(){
    var status = $(this).text();
    var product_id = $(this).attr("product_id");
    $.ajax({
      type:"post",
      url:"/admin/update-product-status",
      data:{status:status,product_id:product_id},
      success:function(resp){
        if(resp['status']==0){
          $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Inactive</a>");
        }else if(resp['status']==1){
          $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Active</a>");
        }
      },error:function(){
        alert("Error");
      }
    })
  });






  // Confirm delete simple jquery alert
    // $('.confirmDelete').click(function(){
    //   var name = $(this).attr("name");
    //   if (confirm("Are you sure you want to delete this" +name+ "?")) {
    //     return true;
    //   }
    //     return false;
    // });

    // Sweet alert delete
      $('.confirmDelete').click(function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
            window.location.href="/admin/delete-"+record+"/"+recordid;
          }
        })
      });
    // });







});
