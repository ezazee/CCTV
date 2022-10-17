$(document).ready(function() {
$('#swdatatable').dataTable({
    "iDisplayLength": 20,
    "aLengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]]
});


function loading(){
    $(".loading").show();
    $(".loading").delay(1500).fadeOut(500);
};

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('.preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});


$("#imgInp2").change(function() {
  readURL(this);
});

 $(".image-link").magnificPopup({type:"image"});
/* ----------- Add ------------*/
$('.add-theme').submit(function (e) {
    if($('#nama').val()==''){    
         swal({title:'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
        return false;
        loading();
    }
    else{
        loading();
        e.preventDefault();
        $.ajax({
            url:"sw-mod/thema-card/proses.php?action=add",
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
                    swal({title: 'Berhasil!', text: 'Tema ID Card berhasil disimpan.!', icon: 'success', timer: 1500,});
                   $('#modalAdd').modal('hide');
                   setTimeout(function(){ location.reload(); }, 1500);
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 1500,});
                }

            },
            complete: function () {
                $(".loading").hide();
            },
        });
    }
  });


/* -------------------- Edit ------------------- */
$('.btn-edit').on('click', function() {
    $('#modal-update').modal('show');
    var id    = $(this).attr("data-id");
    var name  = $(this).attr("data-name");
    var image = $(this).attr("data-image");

    $('#id').val(id);
    $('#name').val(name);
    $('.preview').attr('src','../sw-content/id-card/'+image+'');
});


$('.update').submit(function (e) {
    if($('#name').val()==''){        
         swal({title: 'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 2500,});
         loading();
        return false;
    }
    else{
        loading();
        e.preventDefault();
        $.ajax({
            url:"sw-mod/thema-card/proses.php?action=update",
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
                    swal({title: 'Berhasil!', text: 'Tema ID Card berhasil disimpan.!', icon: 'success', timer: 2500,});
                   $('#modal-update').modal('hide');
                   setTimeout(function(){ location.reload(); }, 2500);

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


/*------------ Delete -------------*/
 $(document).on('click', '.delete', function(){ 
        var id = $(this).attr("data-id");
          swal({
            text: "Anda yakin menghapus data ini?",
            icon: "warning",
              buttons: {
                cancel: true,
                confirm: true,
              },
            value: "delete",
          })

          .then((value) => {
            if(value) {
                loading();
                $.ajax({  
                     url:"sw-mod/thema-card/proses.php?action=delete",
                     type:'POST',    
                     data:{id:id},  
                    success:function(data){ 
                        if (data == 'success') {
                            swal({title: 'Berhasil!', text: 'Data berhasil dihapus.!', icon: 'success', timer: 1500,});
                            setTimeout(function(){ location.reload(); }, 1500);
                        } else {
                            swal({title: 'Gagal!', text: data, icon: 'error', timer: 1500,});
                            
                        }
                     }  
                });  
           } else{  
            return false;
        }  
    });
}); 


/* ------------- Set Active Banner --------------*/
  $(".setactive").click(function(){
            var id = $(this).attr("data-id");
            var active = $("#set"+id).attr("data-active");
            if(active == "1"){
            var dataactive = "2";
            }else{
            var dataactive = "1";
            }
             var dataString = 'id='+ id + '&active='+ dataactive;
            $("#set"+id).html("waiting");
            $.ajax({
                type: "POST",
                url: "sw-mod/thema-card/proses.php?action=setactive",
                data: dataString,
                //cache: false,
                success: function(){
                    if(active == "1"){
                        $("#set"+id).attr("data-active","2");
                        $("#set"+id).attr("class","btn light btn-danger btn-xs");
                        $("#set"+id).html("<i class='fa fa-eye-slash'></i> Nonaktif");
                    }else{
                        $("#set"+id).attr("data-active","1");
                        $("#set"+id).attr("class","btn light btn-primary btn-xs");
                        $("#set"+id).html("<i class='fa fa-eye'></i> Aktif");
                    }
            }
        });
    });


});