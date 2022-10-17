$(document).ready(function () {
  // alert("okey");
  $('#swdatatable').dataTable({
    "iDisplayLength": 31,
    "aLengthMenu": [[31, 50, 100, -1], [31, 50, 100, "All"]],
  });
});