<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    //Hello Word
    $app->get('/404', function (Request $request, Response $response) {
        $response = $this->viewfrontend->render($response->withStatus(404), '404.html', [
            'code' => '404',
            'notfound' => 'Sorry, The page you are looking for is not found...',
            'router' => $this->router]);
        return $response;
    });
