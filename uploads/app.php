<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
trait getInstance
{
    public static $instance;
    public static function getInstance()
    {
        $arg = func_get_args();
        $arg = array_pop($arg);
        return (!(self::$instance instanceof self) || !empty($arg)) ? self::$instance = new static(...(array) $arg) : self::$instance;
    }
    function __set($name, $value)
    {
        $this->$name = $value;
    }
}
function autoload($class)
{
    // Directorios donde buscar archivos de clases
    $directories = array();
    $directorio = dirname(__DIR__) . '/scripts';
    $elementos = scandir($directorio);
    foreach ($elementos as $elemento) {
        $rutaElemento = $directorio.'/'.$elemento.'/';
        if(is_dir($rutaElemento)&& $elemento != '.' && $elemento != '..'){
            $directories[]=$rutaElemento;
        }
    }
    // Convertir el nombre de la clase en un nombre de archivo relativo
    $classFile = str_replace('\\', '/', $class) . '.php';

    // Recorrer los directorios y buscar el archivo de la clase
    foreach ($directories as $directory) {
        $file = $directory . $classFile;
        // Verificar si el archivo existe y cargarlo
        if (file_exists($file)) {
            require $file;
            break;
        }
    }
}
spl_autoload_register('autoload');

work_reference::getInstance(json_decode(file_get_contents("php://input"), true))->getAllWorkRef();

?>