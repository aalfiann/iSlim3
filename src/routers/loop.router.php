<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    // GET example loop route directly from database
    $app->get('/loop', function (Request $request, Response $response) {
        $oStuff = new models\Starter($this->db);
        $results = $oStuff->getAll();
        if ($results != 0){
            $response = $this->viewfrontend->render($response,'loop.html', array('items' => $results));
        } else {
            $response = $this->viewfrontend->render($response,'loop.html', array('items' => 'no records found!'));
        }
        return $response;
    });