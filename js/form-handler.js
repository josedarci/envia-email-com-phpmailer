$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'envia_email.php',
            data: formData,
            success: function (response) {
                Swal.fire(
                    'Sucesso!',
                    'Seu email foi enviado com sucesso.',
                    'success'
                );
            },
            error: function () {
                Swal.fire(
                    'Erro!',
                    'Não foi possível enviar seu email. Tente novamente mais tarde.',
                    'error'
                );
            }
        });
    });
});
