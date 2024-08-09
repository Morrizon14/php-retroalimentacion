$(document).ready(function() {
    $('.btn-ver').click(function(e) {
        e.preventDefault();
        //console.log('Ver');
  
        var user_id = $(this).closest('tr').find('.user_id').text();
        //console.log(user_id);
        $.ajax({
            method: "POST",
            url: '../../../controlador/controlador-principal/controlador-verasesor.php',
            data: {
                'click_btn_ver': true,
                'user_id': user_id,
            },
            success: function(response) {
                /* console.log(response); */
                $('.ver_info_asesor').html(response);
                $('#ver_info_asesor').modal('show');
            }
        });
        // Se limpia los valores del modal ver cuando se cierra el modal
        $("#ver_info_asesor").on("hidden.bs.modal", function() {
            $(this).find(".ver_info_asesor").empty();
        });
    });
    
  });