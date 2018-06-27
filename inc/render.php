<?php

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
    foreach($return['PARTICIPANTES'] as $participante){
        $arrParticipantes[] = $participante['B'];
    }

    /* Consulta se o nome esta na planilha */
    if (in_array(urldecode($_POST['nome']), $arrParticipantes)) { 
        $image = ImageCreateFromJPEG(__DIR__."/Participante_Certificado_BIGDATAGA.jpg"); 
        $white = ImageColorAllocate($image, 255, 255, 255); 
        $black = ImageColorAllocate($image, 46, 29, 29); 
        ImageFill($image, 35, 0, $white); 
        $font = __DIR__.'/OpenSans-Bold.ttf';

        ImageTTFText($image,45, 0, 670, 1523, $black, $font, urldecode($_POST['nome']));
        header("Content-Type: image/jpeg"); 
        header('Content-Disposition: attachment; filename="'.$_POST['nome'].'.jpg"');
        ImageJpeg($image); 
    }else{
        echo "
                <script>
                    alert('Confira seu nome se está preenchido corretamente!');
                    location.href = '../index.php';
                </script>
            ";
    }
    
    