<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //VARIABLES SPDIQUE
    $usuario = "SUPERVISOR@6156";
    $clave = "spdiquemintran";
    $rien = "2";
    $nitSPD = "8060126542";
    $Enturnamiento= "1430";
    $tipoOperacionID = 0;
    
    //Variables de formulario
    $nit = $_POST['nit'];
    $placa = $_POST['placa'];
    $cedula = $_POST['cedula'];
    $fecha = $_POST['fecha'];
    $fechaConvert = new DateTime($fecha);
    $fechaClave =  $fechaConvert ->format('H').$fechaConvert ->format('i').$fechaConvert ->format('s');
    $numero = $_POST['numero'];
    $cliente = $_POST['cliente'];

    //VERIFICAR ESTADO DE LOS CHECKBOX
    if(isset($_POST['descar'])){
        $descargue = $_POST['descar'];
        $tipoOperacionID = 2;
    } else {
        if(isset($_POST['car'])){
        $cargue = $_POST['car'];
        $tipoOperacionID = 1;

        }
    }

    $data = array (
        'acceso' => array(
            'usuario' => $usuario,
            'clave' => $clave,
            'rien' => $rien
        ),

        'variables'=> array(

            'sistemaEnturnamiento'=>array(

                'terminalPortuariaNit' => $nitSPD,
                'sistemaEnturnamientoId'=> $Enturnamiento,

            ),

            'tipoOperacionId' => $tipoOperacionID,
            'empresaTransportadoraNit'=>$nit,

            
            'vehiculos'=>array(
            'vehiculoNumPlaca' => $placa,
            'conductorCedulaCiudadania' => $cedula,
            'fechaOfertaSolicitud' => $fecha,
            'numManifiestoCarga'=> $numero

            )

        )
  
    );


    $json = json_encode($data, JSON_FORCE_OBJECT);
    $json = str_replace('"vehiculos":{', '"vehiculos":[{', $json);
    $json = str_replace('}}', '}]}', $json);    
   

    $client = new Client();
    $url ='https://rndcws2.mintransporte.gov.co/rest/RIEN';

    try {
        // Realiza la solicitud POST con el JSON como cuerpo de la solicitud

        $response = $client->post($url, [
            'body' => $json
        ]);


         // Obtiene la respuesta del servicio web
        $responseData = $response->getBody()->getContents();
        header("Location:paginaPrueba.html?success=" . urlencode($responseData));

        
        $backupName = 'citas/'.$cliente.$placa.$fechaClave.'.json';
        $file = fopen($backupName,'w');
        fwrite($file,$json);
        fclose($file);

        exit;    


    // Maneja la respuesta del servicio web
    } catch (RequestException $e) {  
       
            $errorMsg = $e->getMessage();
            header("Location:paginaPrueba.html?error=" . urlencode($errorMsg));
            exit;    

    }

} else {
    echo "Error al procesar el formulario.";


}
?>
