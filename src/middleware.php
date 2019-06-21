<?php

use Slim\App;

return function (App $app) {
    $app->add(function ($request, $response, $next) {
        if ($request->getParam('token') != $this->get('settings')['access-token']) {
            return $response->withJson(['error' => 'Access is denied'], 403);
        }

        if (!$request->getParam('app') || !$request->getParam('text') || !$request->getParam('type')) {
            return $response->withJson(['error' => 'Bad request'], 400);
        }

        return $next($request, $response);
    });

};
