$(document).ready(function () {
  // alert("okey");
  $('#swdatatable').dataTable({
    "iDisplayLength": 31,
    "aLengthMenu": [[31, 50, 100, -1], [31, 50, 100, "All"]],
  });

  function loading() {
    $(".loading").show();
    $(".loading").delay(1500).fadeOut(500);
  }

  $(document).on('click', '.delete', function () {
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
        if (value) {
          loading();
          $.ajax({
            url: "sw-mod/laporan-kerja/proses.php?action=delete",
            type: 'POST',
            data: { id: id },
            success: function (data) {
              if (data == 'success') {
                swal({ title: 'Berhasil!', text: 'Data berhasil dihapus.!', icon: 'success', timer: 1500, });
                setTimeout(function () { location.reload(); }, 1500);
              } else {
                swal({ title: 'Gagal!', text: data, icon: 'error', timer: 1500, });

              }
            }
          });
        } else {
          return false;
        }
      });
  });
});