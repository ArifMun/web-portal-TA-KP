$(document).ready(function () {
    var table = $("#daftar-pembimbing").DataTable({});
    $("#filter-tahun").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
});
