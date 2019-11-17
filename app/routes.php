<?php
$app->addRoutingMiddleware();

$customErrorHandler = function (
    $request,
    Throwable $exception
) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    return $this->get('view')->render($response, '404.html');
};

$errorHandler = $app->addErrorMiddleware(true, true, true);
$errorHandler->setDefaultErrorHandler($customErrorHandler);

$app->get('/', function ($request, $response) {
    return $this->get('view')->render($response, 'index.html');
})->setName('index');

$user = $container->settings->user;
$app->post('/login', function($request, $response, $user) {
    $_SESSION['login'] = true;
    ['username' => $username, 'password' => $password] = $request->getParsedBody();
    return $this->get('view')->render($response, 'admin.twig', [
        'username' => $username,
        'password' => $password,
        'user' => $user
    ]);
});

$app->get('/login', function ($request, $response) {
    session_start();
    $session = $_SESSION['login'];
    $session = $session ? htmlspecialchars($session) : false;
    if ($session === true) {
        return $this->get('view')->render($response, 'admin.twig');
    } else {
        return $this->get('view')->render($response, 'login.twig');
    }
})->setName('login');
