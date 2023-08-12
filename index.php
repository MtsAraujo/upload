<!DOCTYPE html>
<html>
<head>
    <title>Upload de Arquivos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="flex justify-center items-center">
    <div class='arquivos text-center bg-gray-100 rounded p-10 w-1/3 mt-5 h-full'>
        <form id="uploadForm" onsubmit="return ProcessaSalvamentoArquivos();">
            <label for="file" class="dark:hover:bg-bray-800 flex w-full h-32 cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-100 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pb-6 pt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique</span> ou arraste</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">JPEG, PNG,JPG, DOCX, PDF, PPTX</p>
                </div>
                <input  type="file" name="file" id="file" class="hidden" />
            </label>
            <input type="hidden" value="5" name="razao_id">
            <div class='flex justify-between'>
                <button idRazao='5' type='button' id='AbrirArquivos' onclick='ModalArquivos(this)' class='flex items-center justify-center bg-slate-200 mt-4 ml-1 w-28 px-1 py-2 border-gray-400 border-2 text-black border text-xs font-medium border rounded'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                </button>
                <button class='flex items-center justify-center bg-slate-200 mt-4 ml-1 w-28 px-1 py-2 border-gray-400 border-2 text-black border text-xs font-medium border rounded' type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    Upload
                </button>
            </div>
        </form>     

        <div id="message"></div>
    </div>
    <div class="ModalArquivos"></div>

</body>
</html>
