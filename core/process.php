<?php

$host_aceptados = array('localhost','127.0.0.1');
$metodo_aceptado = 'POST';
$Usuario_correcto = 'Admin';
$password_correcto = "Admin";

$txt_usuario = $_POST["txt_usuario"];
$txt_password = $_POST["txt_password"];
$token = "";

if( in_array($_SERVER["HTTP_HOST"],$host_aceptados) ){

if($_SERVER["REQUEST_METHOD"] == $metodo_aceptado){

    if(isset($txt_usuario) && !empty($txt_usuario)){
        
        if(isset($txt_password) && !empty($txt_password)){

            if($txt_usuario==$Usuario_correcto){

                if($txt_password==$password_correcto){

                    $ruta = "welcome.php";
                    $msg = "";
                    $codigo_estado = 200;
                    $texto_estado = "Ok";
                    list($usec,$sec) = explode('',microtime());
                    $token = base64_encode(date("Y-m-d H:i:s",$sec).substr($usec,1));

                }else{
                    $ruta = "";
                    $msg = "Su Contrasena es incorrecta";
                    $codigo_estado = 400;
                    $texto_estado = "Bad Request";
                    $token = "";
                }
            }else{
                $ruta = "";
                $msg = "No se reconoce el usuario digitado";
                $codigo_estado = 401;
                $texto_estado = "Unauthorized";
                $token = "";
            }

            }else{
                $ruta = "";
                $msg = "El campo de cotrasena esta  vacia";
                $codigo_estado = 401;
                $texto_estado = "Unauthorized";
                $token = "";
            }
        }else{
            $ruta = "";
            $msg = "El campo de cotrasena esta  vacia";
            $codigo_estado = 405;
            $texto_estado = "Method Not Allowed";
            $token = "";
        }
    }else{
        $ruta = "";
        $msg = "Su equipo no esta autorizado para realisar esta peticion";
        $codigo_estado = 403;
        $texto_estado = "Forbidden";
        $token = "";
    }
}

$arreglo_respuesta = array(
    "status" => ((intval($codigo_estado) == 200) ? "ok": "Error" ),
    "error" => ((intval($codigo_estado) == 200) ? " ": array("code"=>$codigo_estado,"message"=>$msg) ),
    "data" => array(
        "url"=>$ruta,
        "token"=>$_token
    ),
    "count"=>1
);

header("HTTP/1.1 ".$codigo_estado."".$texto_estado);
header("Content-Type: Application/json");
echo(json_encode($arreglo_respuesta))

?>