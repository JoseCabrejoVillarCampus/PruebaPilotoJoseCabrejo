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
    $directories = [
        dirname(__DIR__) . '/scripts/academic_area/',
        dirname(__DIR__) . '/scripts/admin_area/',
        dirname(__DIR__) . '/scripts/areas/',
        dirname(__DIR__) . '/scripts/campers/',
        dirname(__DIR__) . '/scripts/chapters/',
        dirname(__DIR__) . '/scripts/contact_info/',
        dirname(__DIR__) . '/scripts/countries/',   
        dirname(__DIR__) . '/scripts/db/'
    ];
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

areas::getInstance(json_decode(file_get_contents("php://input"), true))->getAllAreas();

?>