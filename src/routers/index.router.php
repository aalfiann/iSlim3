<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    //Hello Word
    $app->get('/', function (Request $request, Response $response) {
        //$this->logger->addInfo("Something interesting happened");
        $oStuff = new models\Starter();
        $hello = $oStuff->setHello();

        $response = $this->viewfrontend->render($response, "index.html", [
            "hello" => $hello['hello'],
            "description1" => $hello['description1'],
            "description2" => $hello['description2'],
            "author" => $hello['author']]);
        return $response;
    })->setName("/");
