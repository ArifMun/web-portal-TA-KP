$(document).ready(function () {
    $("#konsentrasi").select2({
        placeholder: "-- Pilih Konsentrasi --",
        width: "100%",
    });
});
$(document).ready(function () {
    $(".konsentrasi").select2({
        width: "100%",
    });
});
$(document).ready(function () {
    $(".konsentrasi_").select2({
        width: "100%",
    });
});

// Daftar Akun
$(document).ready(function () {
    $("#keahlian").select2({
        placeholder: "-- Pilih Keahlian --",
        width: "100%",
    });
});
$(document).ready(function () {
    $(".keahlian_").select2({
        placeholder: "-- Pilih Keahlian --",
        width: "100%",
    });
});

$(document).ready(function () {
    $("#keahlian_").select2({
        // placeholder: "-- Pilih Konsentrasi --",
        width: "100%",
    });
});

$(document).ready(function () {
    $("#konsentrasi__").select2({
        placeholder: "-- Pilih Konsentrasi --",
        width: "100%",
    });
});
$(document).ready(function () {
    $("#konsentrasi_1").select2({
        placeholder: "-- Pilih Konsentrasi --",
        width: "100%",
    });
});

// Daftar Akun
$(document).ready(function () {
    $(".modalTambahAkun").on("show.bs.modal", function () {
        var formId = "#" + $(this).attr("id");
        toggleKolomBaru_1(formId);

        $(formId + " #jabatan").on("change", function () {
            toggleKolomBaru_1(formId);
        });

        function toggleKolomBaru_1(formId) {
            if ($(formId + ' select[name="jabatan"]').val() === "dosen") {
                $("#keahlian").prop("disabled", false);
                $("#nama_ayah").prop("disabled", true);
                $("#nama_ibu").prop("disabled", true);
                $("#alamat_ortu").prop("disabled", true);
                $("#no_hp_ortu").prop("disabled", true);
                $("#pekerjaan_ortu").prop("disabled", true);
            } else if (
                $(formId + ' select[name="jabatan"]').val() === "mahasiswa"
            ) {
                $("#keahlian").prop("disabled", true);
                $("#nama_ayah").prop("disabled", false);
                $("#nama_ibu").prop("disabled", false);
                $("#alamat_ortu").prop("disabled", false);
                $("#no_hp_ortu").prop("disabled", false);
                $("#pekerjaan_ortu").prop("disabled", false);
            } else if (
                $(formId + ' select[name="jabatan"]').val() === "TU" ||
                "kaprodi"
            ) {
                $("#keahlian").prop("disabled", true);
                $("#nama_ayah").prop("disabled", true);
                $("#nama_ibu").prop("disabled", true);
                $("#alamat_ortu").prop("disabled", true);
                $("#no_hp_ortu").prop("disabled", true);
                $("#pekerjaan_ortu").prop("disabled", true);
            }
        }
    });
});

// Edit Akun 
$(document).ready(function () {
    $(".modalEditAkun").on("show.bs.modal", function () {
        var modal = $(this);
        toggleKolomBaru_2(modal);

        modal.find(".jabatan_1").on("change", function () {
            toggleKolomBaru_2(modal);
        });

        function toggleKolomBaru_2(modal) {
            if (
                modal.find('select[name="jabatan"]').val() === "dosen" ||
                modal.find('select[name="jabatan"]').val() === "kaprodi"
            ) {
                modal.find("#keahlian_").prop("disabled", false);
                modal.find("#nama_ayah_").prop("disabled", true);
                modal.find("#nama_ibu_").prop("disabled", true);
                modal.find("#alamat_ortu_").prop("disabled", true);
                modal.find("#no_hp_ortu_").prop("disabled", true);
                modal.find("#pekerjaan_ortu_").prop("disabled", true);
            } else {
                modal.find("#keahlian_").prop("disabled", true);
                modal.find("#nama_ayah_").prop("disabled", false);
                modal.find("#nama_ibu_").prop("disabled", false);
                modal.find("#alamat_ortu_").prop("disabled", false);
                modal.find("#no_hp_ortu_").prop("disabled", false);
                modal.find("#pekerjaan_ortu_").prop("disabled", false);
            }
        }
    });
});
