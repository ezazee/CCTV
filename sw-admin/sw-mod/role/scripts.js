$(()=>{

  function loading() {
    $(".loading").show();
    $(".loading").delay(1500).fadeOut(500);
  }

  $('.role-created').click(function(){
    var isCreated = null;
    var isCreatedId = $(this).data('id');
    if($(this).prop("checked") == true){
        isCreated = '1';
    }else if($(this).prop("checked") == false){
        isCreated = '0';
    }
    
    $.ajax({
      url:"sw-mod/role/proses.php?action=iscreated",
      type:"POST",
      data:{
        isCreated:isCreated,
        isCreatedId:isCreatedId
      },
      beforeSend:function(){
        loading()
      },
    });
  });

  $('.role-updated').click(function(){
    var isUpdated = null;
    var isUpdatedId = $(this).data('id');
    if($(this).prop("checked") == true){
        isUpdated = '1';
    }else if($(this).prop("checked") == false){
        isUpdated = '0';
    }
    
    $.ajax({
      url:"sw-mod/role/proses.php?action=isupdated",
      type:"POST",
      data:{
        isUpdated:isUpdated,
        isUpdatedId:isUpdatedId
      },
      beforeSend:function(){
        loading()
      },
    });
  });
 
  $('.role-deleted').click(function(){
    var isDeleted = null;
    var isDeletedId = $(this).data('id');
    if($(this).prop("checked") == true){
        isDeleted = '1';
    }else if($(this).prop("checked") == false){
        isDeleted = '0';
    }
    
    $.ajax({
      url:"sw-mod/role/proses.php?action=isdeleted",
      type:"POST",
      data:{
        isDeleted:isDeleted,
        isDeletedId:isDeletedId
      },
      beforeSend:function(){
        loading()
      },
    });
  });
  
  $('.role-upload').click(function(){
    var isUpload = null;
    var isUploadId = $(this).data('id');
    if($(this).prop("checked") == true){
        isUpload = '1';
    }else if($(this).prop("checked") == false){
        isUpload = '0';
    }
    
    $.ajax({
      url:"sw-mod/role/proses.php?action=isupload",
      type:"POST",
      data:{
        isUpload:isUpload,
        isUploadId:isUploadId
      },
      beforeSend:function(){
        loading()
      },
    });
  });
  
  $('.role-download').click(function(){
    var isDownload = null;
    var isDownloadId = $(this).data('id');
    if($(this).prop("checked") == true){
        isDownload = '1';
    }else if($(this).prop("checked") == false){
        isDownload = '0';
    }
    
    $.ajax({
      url:"sw-mod/role/proses.php?action=isdownload",
      type:"POST",
      data:{
        isDownload:isDownload,
        isDownloadId:isDownloadId
      },
      beforeSend:function(){
        loading()
      },
    });
  });

  $('.add-user-role').submit(function (e) {
    if($('#role-user').val()==''){    
        swal({title:'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
        return false;
    }
    else{
        e.preventDefault();
        $.ajax({
            url:"sw-mod/role/proses.php?action=created",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function () { 
              loading();
            },
            success: function (data) {
                if (data == 'success') {
                    swal({title: 'Berhasil!', text: 'Data Role User berhasil disimpan.!', icon: 'success', timer: 2500,});
                   window.setTimeout(window.location.href = "./role",2500);
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 2500,});
                }

            },
            complete: function () {
                $(".loading").hide();
            },
        });
    }
  });
});