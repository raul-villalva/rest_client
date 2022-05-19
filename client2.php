<?php



$cookies = "";

if (empty($argv[1])) {
    die("defina una ruta del archivo\n");
}

$path = $argv[1];
$pos = 0;
while (true) { 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:3000/leer?path=$path&pos=$pos");
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);

        $body = substr($response, $header_size);
        curl_close($ch);

    
      
        if( empty($body)){
            break;
        }
        $pos+= 200;


        $ch = curl_init( "http://localhost:3000/escribir" );
        $payload = json_encode( array( "path"=>  $path . "_copia_server", "buffer"=> $body ) );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
       

        $file = fopen($path . "_copia_client", 'a');

        fwrite( $file, $body);
        fclose($file);

       
}


exit(0);