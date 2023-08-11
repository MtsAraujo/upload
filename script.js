function ProcessaSalvamentoArquivos() {
    var formData = new FormData(document.getElementById("uploadForm"));

    $.ajax({
        url: "upload.php", 
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $("#message").html(response); 
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

    return false; // Impede o envio padrão do formulário
};

function ModalArquivos(button){

    var idRazao = button.getAttribute('idRazao');
    $.ajax({
        url: 'upload.php',
        method: 'POST',
        dataType: 'JSON',
        data: {
            idRazaoArquivo: idRazao,
        },
        success: function(response) {
            $(".ModalArquivos").html(response.view);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(jqXHR, textStatus, errorThrown);
        }
    });
  };

function closeModalArquivo() {
    var modal = document.getElementById('ArquivoModal');
    modal.classList.add('hidden');
};