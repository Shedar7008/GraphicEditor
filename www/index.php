<?php

require __DIR__ . '/../includes.php';

$sapiType = php_sapi_name();
if (substr($sapiType, 0, 3) == 'cgi') {
    $shape = $_GET['type'] ?? '';
    array_shift($_GET);

    //Transform array to a proper form
    $params = [];
    foreach ($_GET as $key => $value) {
        $params[] = $value;
    }
}
elseif(substr($sapiType, 0, 3) == 'cli'){
    $shape = $argv[1] ?? '';
    array_shift($argv);
    array_shift($argv);
    $params = $argv;
}
else
{
    die("Unknown SAPI.");
}

$module = "draw";
$method = "drawShape";

$moduleName = ucfirst($module);
$controllerName = $moduleName . 'Controller';
$className = "GraphicEditor\\Module\\$moduleName\\$controllerName";
$controller = new $className($params);


try {
    $data = $controller->$method($shape, $params);
} catch (\Exception $e) {
    $data = $e->getMessage();
}

print_r($data);