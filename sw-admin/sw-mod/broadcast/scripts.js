$(()=>{
  
  $("#keseluruhan-anggota-checkbox").click(function() {
    var checked_status = this.checked;
    if (checked_status == true) {
        $('#keseluruhan-anggota-checkbox-value').val("1");
        $("#penempatan-anggota-checkbox ").attr("disabled", "disabled");
        $("#salah-satu-anggota-checkbox").attr("disabled", "disabled");
      } else {
        $('#keseluruhan-anggota-checkbox-value').val("");
        $("#salah-satu-anggota-checkbox").removeAttr("disabled");
        $("#penempatan-anggota-checkbox ").removeAttr("disabled");
    }
  });

  $("#penempatan-anggota-checkbox").click(function() {
    var checked_status = this.checked;
    if (checked_status == true) {
        $('#penempatan-anggota-checkbox-value').val("1");
        $("#penempatan-anggota-button").removeAttr("disabled");
        $("#keseluruhan-anggota-checkbox").attr("disabled", "disabled");
        $("#salah-satu-anggota-checkbox").attr("disabled", "disabled");
      } else {
        $('#penempatan-anggota-checkbox-value').val("");
        $("#salah-satu-anggota-checkbox").removeAttr("disabled");
        $("#keseluruhan-anggota-checkbox").removeAttr("disabled");
        $("#penempatan-anggota-button").attr("disabled", "disabled");
    }
  });

  $('#penempatan-anggota-button').select2();


  $("#salah-satu-anggota-checkbox").click(function() {
    var checked_status = this.checked;
    if (checked_status == true) {
       $("#salah-satu-anggota-checkbox-value").val("1");
       $("#salah-satu-anggota-button").removeAttr("disabled");
       $("#keseluruhan-anggota-checkbox").attr("disabled", "disabled");
       $("#penempatan-anggota-checkbox").attr("disabled", "disabled");
    } else {
       $("#salah-satu-anggota-checkbox-value").val("");
       $("#salah-satu-anggota-button").attr("disabled", "disabled");
       $("#keseluruhan-anggota-checkbox").removeAttr("disabled");
       $("#penempatan-anggota-checkbox").removeAttr("disabled");
    }
  });

  $('#salah-satu-anggota-button').select2();
  

  $(document).on('submit','#uploadFile', function(e){
    e.preventDefault();
    var formData  = new FormData(this);
    console.log(formData);
      $.ajax({
      url: "sw-mod/broadcast/proses.php?action=tambah",
      method: "POST",
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        showModal();
      },
      success: function(res) {
        destroyModal()
        if (res === 'success') {
          alert('success');
          window.setTimeout(window.location.href = "./broadcast",2500);
        }
        if(res === 'validation'){
          alert('tujuan broadcast');
        }
        if(res === 'error'){
          alert('Data Gagal Di simpan')
        }
      }
    })
  });

  function destroyModal(){
    $('body').loadingModal('destroy');
  }

  function showModal() {
    $('body').loadingModal({
        text: 'Mohon Tunggu Sebentar...'
      })
      .loadingModal('animation', 'wave')
      .loadingModal('backgroundColor', '#00C3B6');
  }
})