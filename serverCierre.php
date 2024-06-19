<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$nombreP1 = $_POST['nombreP1'];
$nombreP2 = $_POST['nombreP2'];
$fechaEntrada = $_POST['fechaEntrada'];
$pesoIn = $_POST['pesoEntrada'];
$fechaSalida = $_POST['fechaSalida'];
$pesoOut = $_POST['pesoSalida'];
$fechaTurno = $_POST['fechaNombre'];
$fechaConvert = new DateTime($fechaTurno);
$fechaClave =  $fechaConvert ->format('H').$fechaConvert ->format('i').$fechaConvert ->format('s');



$reemplazos = array(
    '"vehiculos":[{' => '',
    '}]}}' => '}}',
    '"rien":"2"' => '"rien":"1"'
);


// crear en html rubro de fecha de solitud en la pagina de cierre y acceder a ese nuevo nombre para cerrar las citas
$nombreCompleto = $nombreP1.$nombreP2.$fechaClave;
$rutaJson = 'citas/' . $nombreCompleto . '.json';
$jsonActual = file_get_contents($rutaJson);
$jsonModificado = str_replace(array_keys($reemplazos), array_values($reemplazos), $jsonActual); 


$data =  json_decode($jsonModificado, true);
$grupo = &$data['variables'];

$nuevadata  = array (

    'fecha' => $fechaEntrada,
    'tiemposProceso'  => array(
    'entradaTerminal'=> $fechaEntrada,
    'pesajeEntrada' => $pesoIn,
    'salidaTerminal' => $fechaSalida,
    'pesajeSalida' => $pesoOut
    )


    
);

$grupo['turnoAsignado'] = $nuevadata;
$jsonModificado = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents($rutaJson, $jsonModificado);

$client = new Client();
    
    $url ='https://rndcws2.mintransporte.gov.co/rest/RIEN';

    try {
        // Realiza la solicitud POST con el JSON como cuerpo de la solicitud

        $response = $client->post($url, [
            'body' => $jsonModificado
        ]);


         // Obtiene la respuesta del servicio web
        $responseData = $response->getBody()->getContents();
        header("Location:PaginaCierre.html?success=" . urlencode($responseData));

        
        $backupName = 'citas/'.$cliente.$placa. '.json';
        $file = fopen($backupName,'w');
        fwrite($file,$jsonModificado);
        fclose($file);

        unlink($link);

        exit;    


    // Maneja la respuesta del servicio web
    }   catch (RequestException $e) {  
                    if ($e->hasResponse()) {
                              $response = $e->getResponse();
            
                               $errorData = json_decode($response->getBody(), true);
            
                              // Mostrar solo una parte específica del JSON de error
                              if (isset($errorData['ErrorText'])) {
                                    header("Location:PaginaPrueba.php?error=" . rawurlencode($errorData['ErrorText']));
                              } else {
                                    header("Location:PaginaPrueba.php?error=" . rawurlencode("Error desconocido"));
                              }
            
                        } else {
                              $errorMsg = $e->getMessage();
                              header("Location:PaginaPrueba.php?error=" . rawurlencode($errorMsg));
                        }
            
                        exit;  
            
    }



} else {
    echo "Error al procesar el formulario.";

}


?>
