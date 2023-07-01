    $(document).ready(function() {
        $('.modalMelanjutkan').on('show.bs.modal', function() {
            var formId = '#' + $(this).attr('id');
            toggleKolomBaru_2(formId);
        
        $(formId + ' #d_ganti_2').on('change', function() {
            toggleKolomBaru_2(formId);
        });
        
        function toggleKolomBaru_2(formId) {
            if ($(formId + ' input[name="ganti_pembimbing"]:checked').val() === 'ya') {
                $(formId + ' #kolomBaru_2').show();
                console.log('haha');
            } else {
                $(formId + ' #kolomBaru_2').hide();
                }
            }
        });
    });