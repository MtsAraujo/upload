<?php
include "db.php";

//MODAL ARQUIVOS
if (isset($_POST["idRazaoArquivo"])) {

        $idRazaoArquivo = $_POST["idRazaoArquivo"];

        $sql = "SELECT * FROM arquivos";
        $result = $con->query($sql);

        $popupArquivo = "";
        $popupArquivo .= "
        <div id='ArquivoModal' class='fixed inset-0 z-50 flex text-center items-center justify-center bg-gray-500 bg-opacity-100 overflow-auto'>
            <div class='w-full max-w-2xl md:w-2/3 rounded-lg bg-white p-6 flex flex-col'>
                <h2 class='text-xl font-bold'>Arquivos $idRazaoArquivo</h2>";

        if ($result->num_rows > 0) {
            $popupArquivo .= "<div class='grid grid-cols-5 gap-4 mt-6'>";
            
            while ($row = $result->fetch_assoc()) {
                $nome = $row['nome'];
                $path = $row['path'];
                
                $popupArquivo .= "
                <a class='md:w- ' target='_blank' href='$path'>
                    <div class='flex flex-col rounded-lg items-center justify-center bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-100 sm:shrink-0 sm:grow sm:basis-0'>
                        <div class='p-6'>
                            <h5 class='text-xl font-medium leading-tight'>$nome</h5>
                        </div>
                        <img style='max-width: 80%;' class='rounded mb-4' src='$path' alt='$nome' /> 
                    </div>
                </a>";
            }
            
            $popupArquivo .= "</div>";
        }

        $popupArquivo .= "
                <button onclick='closeModalArquivo()' class='mt-4 self-center w-28 rounded bg-red-500 py-2 text-sm font-bold text-white hover:bg-red-700 md:w-1/5' type='button'>Fechar</button>
            </div>
        </div>";

        echo json_encode(array("view" => $popupArquivo), JSON_UNESCAPED_UNICODE);
        exit;
};
//MODAL ARQUIVOS

//PROCESSA ARQUIVOS
if (isset($_FILES["file"]) && isset($_POST["razao_id"])) {
  $arquivo = $_FILES["file"];
  $nomeArquivo = $arquivo["name"];
  $razao = $_POST["razao_id"];
  $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

  // Adicionar um número único ao nome do arquivo
  $nomeArquivoUnico = uniqid() . '_' . $nomeArquivo;

  if ($arquivo["size"] > 5000000) { // 5MB
      echo json_encode(array("message" => "Arquivo de no máximo 5MB"), JSON_UNESCAPED_UNICODE);
  } else if (!in_array($extensao, array("jpg", "png", "jpeg", "pdf", "docx", "xls"))) {
      echo json_encode(array("message" => "Formatos permitidos: JPG, PNG, JPEG, PDF, DOCX, XLS"), JSON_UNESCAPED_UNICODE);
  } else {
      $pasta = "arquivos/$razao/";
      $path = $pasta . $nomeArquivoUnico;
      $arquivado = move_uploaded_file($arquivo["tmp_name"], $path);
      $dataAtual = date('Y-m-d');

      if ($arquivado) {
          $con->query("INSERT INTO arquivos (nome, path, data_upload, id_razao) VALUES('$nomeArquivo','$path','$dataAtual','$razao')");
          echo json_encode(array("message" => "Arquivo salvo com sucesso"), JSON_UNESCAPED_UNICODE);
      } else {
          echo json_encode(array("message" => "FALHA AO ENVIAR ARQUIVO"), JSON_UNESCAPED_UNICODE);
      }
  }
}

//PROCESSA ARQUIVOS