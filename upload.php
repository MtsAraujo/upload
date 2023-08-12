<?php
include "db.php";

//MODAL ARQUIVOS
if (isset($_POST["idRazaoArquivo"])) {

        $idRazaoArquivo = $_POST["idRazaoArquivo"];

        $sql = "SELECT r.nome AS nome_razaosocial, a.nome AS nome_arquivo, a.path FROM arquivos a INNER JOIN razaosocial r ON a.id_razao = r.id WHERE a.id_razao = $idRazaoArquivo";
        $result = $con->query($sql);

        $popupArquivo = "";
        if ($result->num_rows > 0) {
            $popupArquivo .= "
            <div id='ArquivoModal' class='fixed w-full h-full inset-0 z-50 items-center justify-center bg-gray-500 bg-opacity-100 overflow-auto'>
                <div class='mt-5 mb-5 mr-5 ml-5 rounded-lg bg-white p-6 '>    
                    <div class='flex justify-between'>
                        <h2 class='text-center text-2xl font-bold'>Nome da Prefeitura</h2>
                        <button onclick='closeModalArquivo()' class='w-9 rounded bg-red-500 py-2 text-sm font-bold text-white hover:bg-red-700' type='button'>X</button>
                    </div>
                    <div class='grid grid-cols-5 gap-4 mt-6'>";

            while ($row = $result->fetch_assoc()) {
                $nomeArquivo = $row['nome_arquivo'];
                $path = $row['path'];
                $extensao = pathinfo($path, PATHINFO_EXTENSION);
                $popupArquivo .= "
                    <div class='mx-3 mt-6 flex-col self-start rounded-lg bg-slate-200 h-52'>
                        <a class='mb-5' target='_blank'href='$path'>
                            ";
                            if (strtolower($extensao) === 'pdf') {
                                $popupArquivo .= "
                                                <div class='flex py-2 px-2 mt-2'>
                                                    <img class='mx-3' src='./img-auxiliar/pdfIcon.png' alt='icon pdf'><h5 class='text-center text-xl font-medium leading-tight text-neutral-800 truncate'>$nomeArquivo</h5>
                                                </div>
                                                <div class='w-full h-full overflow-hidden'>
                                                   <iframe class='object-none h-5/6 w-full p-6 object-fill' scrolling='no' src='$path' alt='$nomeArquivo'></iframe>
                                                </div>";
                            } else if (in_array(strtolower($extensao), ['png', 'jpeg', 'jpg'])) {
                                $popupArquivo .= "
                                                <div class='flex py-2 px-2 mt-2'>
                                                    <img class='mx-3 ' src='./img-auxiliar/imgIcon.png' alt='icon img'><h5 class='text-center text-xl font-medium leading-tight text-neutral-800 truncate'>$nomeArquivo</h5>
                                                </div>
                                                <div class='w-full h-full overflow-hidden'>
                                                    <img class='h-5/6 w-auto p-6 mx-auto' src='$path' alt='$nomeArquivo' />
                                                </div>";
                            }elseif (strtolower($extensao) === 'pptx'){
                                $popupArquivo .= "
                                                <div class='flex py-2 px-2 mt-2'>
                                                    <img class='mx-3' src='./img-auxiliar/powerpointIcon.png' alt='icon powerpoint'><h5 class='text-center text-xl font-medium leading-tight text-neutral-800 truncate'>$nomeArquivo</h5>
                                                </div>
                                                <div class='w-full h-full overflow-hidden'>
                                                    <img class='h-5/6 w-auto p-6 mx-auto' src='./img-auxiliar/powerpoint.jpg' alt='powerpoint' />
                                                </div>";
                            }elseif (strtolower($extensao) === 'xlsx'){
                                $popupArquivo .= "
                                                <div class='flex py-2 px-2 mt-2'>
                                                    <img class='mx-3' src='./img-auxiliar/exelIcon.png' alt='icon exel'><h5 class='text-center text-xl font-medium leading-tight text-neutral-800 truncate'>$nomeArquivo</h5>
                                                </div>
                                                <div class='w-full h-full overflow-hidden'>
                                                    <img class='h-5/6 w-auto p-6 mx-auto' src='./img-auxiliar/exel.png' alt='exel' />
                                                </div>";
                            }
                            $popupArquivo .= "</a>
                    </div>";
            };
        };

        $popupArquivo .= "
                </div>
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
  } else if (!in_array($extensao, array("jpg", "png", "jpeg", "pdf", "docx", "xlsx","pptx"))) {
      echo json_encode(array("message" => "Formatos permitidos: JPG, PNG, JPEG, PDF, DOCX, XLSX"), JSON_UNESCAPED_UNICODE);
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