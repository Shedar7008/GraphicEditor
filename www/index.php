<?php

use Shop\Core\MainView;
use Shop\Module\Guest\Guest;
use Shop\Module\Guest\GuestRepository;
use Shop\Module\User\AuthorizedView;
use Shop\Module\User\NotAuthorizedView;
use Shop\Module\User\User;
use Shop\Module\User\UserRepository;

require __DIR__ . '/../includes.php';

if (!array_key_exists('GUEST_ID', $_COOKIE)) {
    $guestRepository = GuestRepository::getInstance();
    $guestID = $guestRepository->addItem(new Guest());
    setcookie('GUEST_ID', $guestID, strtotime('+1 day'));
    $_COOKIE['GUEST_ID'] = $guestID;
}

$module = $_GET['module'] ?? null;
$method = $_GET['method'] ?? null;
$ajax = $_GET['ajax'] ?? null;

if (!$module || !$method) {
    header("HTTP/1.0 404 Not Found");
    die();
}

$moduleName = ucfirst($module);
$controllerName = $moduleName . 'Controller';
$className = "Shop\\Module\\$moduleName\\$controllerName";
$controller = new $className();
$title = '';
try {
    $html = $controller->$method($title);
} catch (Exception $e) {
    $html = $e->getMessage();
}

if (array_key_exists('ajax', $_GET)) {
    echo $html;
    die();
}

$userRepository = UserRepository::getInstance();
$user = $userRepository->getUser();
if ($user instanceof User) {
    $authorizedView = new AuthorizedView();
    $userHtml = $authorizedView->fill(['NAME' => $user->getName()]);
} else {
    $notAuthorizedView = new NotAuthorizedView();
    $userHtml = $notAuthorizedView->fill();
}

$mainView = new MainView();
$html = $mainView->fill([
    'WORK_AREA' => $html,
    'TITLE' => $title,
    'USER' => $userHtml,
]);
echo $html;