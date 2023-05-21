<?
    require_once 'controllers/error.php';
    class App{
        function __construct(){
            echo $_GET["url"];
            $url = isset($_GET["url"]) ? $_GET ["url"] : null;
            $url = rtrim($url,"/");
            $url = explode("/", $url);
            //var_dump($url);           

           if (empty($url[0])) {
                error_log('APP::construct-> No hay controlador especificado.');
                $archivoControlador = 'controllers/login.php';
                require_once $archivoControlador;
                $controller = new Login();
                $controller-> loadModel('Login');
                $controller-> render();
                return false;
           }

           $archivoControlador = 'controllers/'.$url[0].'.php';

           if(file_exists($archivoControlador)){
                require_once $archivoControlador;

                $controller = new $url[0];
                $controller-> loadModel($url[0]);

                if(isset($url[1])){
                    if(method_exists($controller, $url[1])){
                        if(isset($url[2])){

                            $nparam = count($url) -2;

                            $params = [];

                            for($i = 0; $i< $nparam; $i++){
                                array_push($params, $url[$i] + 2);
                            }

                            $controller->{$url[1]}($params);
                        }else{
                                //no tiene parametros así que no llama nada extra jaja un poquito obvio 
                            $controller->{$url[1]}();
                            }
                    }
                }
           }else{
                $controller-> render();
                //no existe el archivo so se mannda el error especificando la inexistencia de este :D
           }
        
        }
    }        
?>      