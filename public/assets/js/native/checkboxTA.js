$(document).ready(function () {
    $(".modalEditTA").on("show.bs.modal", function () {
        var formId = "#" + $(this).attr("id");
        toggleKolomBaru_1(formId);

        $(formId + " #d_ganti_1").on("change", function () {
            toggleKolomBaru_1(formId);
        });

        function toggleKolomBaru_1(formId) {
            if (
                $(formId + ' input[name="ganti_pembimbing"]:checked').val() ===
                "ya"
            ) {
                $(formId + " #kolomBaru_1").show();
            } else {
                $(formId + " #kolomBaru_1").hide();
            }
        }
    });
});
$(document).ready(function () {
    $("#modalMelanjutkan").on("show.bs.modal", function () {
        var formId = "#" + $(this).attr("id");
        toggleKolomBaru_2(formId);

        $(formId + " #d_ganti_2").on("change", function () {
            toggleKolomBaru_2(formId);
        });

        function toggleKolomBaru_2(formId) {
            if (
                $(formId + ' input[name="ganti_pembimbing"]:checked').val() ===
                "ya"
            ) {
                $(formId + " #kolomBaru_2").show();
                console.log("success");
            } else {
                $(formId + " #kolomBaru_2").hide();
            }
        }
    });
});
