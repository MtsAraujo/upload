<!DOCTYPE html>
<html>
<head>
    <title>Upload de Arquivos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="flex justify-center items-center">
    <div class='arquivos text-center'>
        <h2 class='text-2xl'>Razao 5</h2>
        <form id="uploadForm" onsubmit="return ProcessaSalvamentoArquivos();">
            <label for="file">Escolha ou arraste um arquivo:</label>
            <input required type="file" name="file" id="file">
            <input type="hidden" value="5" name="razao_id">
            <input class='relative mt-4 ml-1 w-28 px-1 py-2 cursor-pointer text-xs font-medium text-white rounded-lg bg-primary' type="submit" value="Enviar">
        </form>
        <br>
        <div id="message"></div>

        <bumtton idRazao='5' id='AbrirArquivos' onclick='ModalArquivos(this)' class='cursor-pointer relative mt-4 ml-1 w-28 px-1 py-2 text-xs font-edium text-white rounded-lg bg-primary flex justify-center items-center'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
        </button>
    </div>
    <div class="ModalArquivos"></div>

</body>
</html>
