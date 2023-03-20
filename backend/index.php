<?php
require __DIR__ . "/inc/boot.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$validController = array_search('quotes', $uri);
if (!$validController) {
    header("HTTP/1.1 404 Not Found");
    exit();
}


require PROJECT_ROOT_PATH . "/Controller/Api/QuotesController.php";
$objFeedController = new QuotesController();
$strMethodName = $uri[$validController+1] . 'Action';
$objFeedController->{$strMethodName}();
?>