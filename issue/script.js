$('table').DataTable();
$(document).ready(function() {
  // DataTable initialisation
  $('#example').DataTable({
    "paging": true,
    "autoWidth": true,
    "columnDefs": [
      {
        "targets": 3,
        "render": function(data, type, full, meta) {
          var cellText = $(data).text(); //Stripping html tags !!!
          if (type === 'display' &&  (cellText == "selesai" || data=='selesai')) {
            var rowIndex = meta.row+1;
            var colIndex = meta.col+1;
            $('#example tbody tr:nth-child('+rowIndex+')').addClass('lightRed');
            $('#example tbody tr:nth-child('+rowIndex+') td:nth-child('+colIndex+')').addClass('red');
            return data;
          } else {
            return data;
          }
        }
      }
    ]
  });
});