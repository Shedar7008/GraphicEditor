<?php

require __DIR__ . '/../includes.php';

// /index.php?type=circle&p1=5&p2=yellow&p3=2

$sapiType = php_sapi_name();
if (substr($sapiType, 0, 3) == 'cgi') {
    $shape = $_GET['type'] ?? null;
    array_shift($_GET);

    $params = [];
    foreach ($_GET as $key => $value) {
        $params[] = $value;
    }

    if (!$shape || !$params[0] || !$params[1]  || !$params[2]  ) {
        header("HTTP/1.0 404 Not Found");
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
$method = "list";

$moduleName = ucfirst($module);
$controllerName = $moduleName . 'Controller';
$className = "Shop\\Module\\$moduleName\\$controllerName";
$controller = new $className($params);


try {
    $data = $controller->$method($shape, $params);
} catch (\Exception $e) {
    $data = $e->getMessage();
}

print_r($data);

