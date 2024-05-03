$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this); // Cria um FormData com os dados do formulário

        $.ajax({
            url: 'envia_email.php', // O endpoint no servidor que receberá o arquivo e os dados
            type: 'POST',
            data: formData,
            contentType: false, // Necessário para o envio de arquivos
            processData: false, // Necessário para o envio de arquivos
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('#progressBar').css('width', percentComplete + '%');
                        $('#progressBar').attr('aria-valuenow', percentComplete);
                        $('#progressBar').text(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
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
