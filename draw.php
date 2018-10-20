<?php
require __DIR__ . '/includes.php';
//Input {\"type\":\"circle\",\"params\":{\"color\":\"yellow\",\"border_size\":1}}

/*$params = [];
if(array_key_exists(1, $argv))
{
    $params = json_decode($argv['1'], true);
    file_put_contents('test.txt', print_r($params, true));
}

print_r($params);
*
 *
 */

$shape = $argv[1] ?? '';
array_shift($argv);
array_shift($argv);
$params = $argv;

$module = "draw";
$method = "list";

$moduleName = ucfirst($module);
$controllerName = $moduleName . 'Controller';
$className = "Shop\\Module\\$moduleName\\$controllerName";
$controller = new $className($params);

try {
    $html = $controller->$method($shape, $params);
} catch (\Exception $e) {
    $html = $e->getMessage();
}

print_r($html);