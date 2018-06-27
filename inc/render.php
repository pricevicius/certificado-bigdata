<?php

    function tirarAcentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }

    /* *
        Carrega a planilha!
    */
    require_once __DIR__."/PHPExcel.php";
    $fileName = "lista-etiquetas.xls";
    /** detecta automaticamente o tipo de arruivo que será carregado */
    $excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);
    $excelObj = $excelReader->load($fileName);
    $worksheetNames = $excelObj->getSheetNames($fileName);
    $return = array();
    foreach($worksheetNames as $key => $sheetName){  
        $excelObj->setActiveSheetIndexByName($sheetName);
        $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
    }
    unset($return['PARTICIPANTES'][1]);
    $arrParticipantes = array();
    $a=0;
    foreach($return['PARTICIPANTES'] as $participante){
        $arrParticipantes[$a] = $participante['B'];
        $arrParticipantesAcentos[$a] = tirarAcentos($participante['B']);
        $a++;
    }
    $postNome = mb_strtoupper(urldecode($_POST['nome']),'UTF-8');
    
    /* Consulta se o nome esta na planilha */
    if (in_array($postNome, $arrParticipantes) || in_array($postNome, $arrParticipantesAcentos) ) { 
        $thisName = array_search(tirarAcentos($postNome),$arrParticipantesAcentos);
        $image = ImageCreateFromJPEG(__DIR__."/Participante_Certificado_BIGDATAGA.jpg"); 
        $white = ImageColorAllocate($image, 255, 255, 255); 
        $black = ImageColorAllocate($image, 46, 29, 29); 
        ImageFill($image, 35, 0, $white); 
        $font = __DIR__.'/OpenSans-Bold.ttf';

        ImageTTFText($image,45, 0, 670, 1523, $black, $font, $arrParticipantes[$thisName]);
        header("Content-Type: image/jpeg"); 
        header('Content-Disposition: attachment; filename="'.$arrParticipantesAcentos[$thisName].'.jpg"');
        ImageJpeg($image); 
    }else{
        echo "
                <script>
                    alert('Confira seu nome se está preenchido corretamente!');
                    location.href = '../index.php';
                </script>
            ";
    }
    
    