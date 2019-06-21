<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\TelegramApi\Bot;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {
        $channel = $container->get('settings')['telegram']['channel'];

        /**
         * type= info|warn|danger|success|notify
         * app= - name app sender
         * text=
         */

        $bot = new Bot($container->get('settings')['telegram']['token']);
        $bot->sendMessage($channel, $request->getParam('text'));

        $context = [
            'app' => $request->getParam('app')
        ];

        $container->get('logger')->info($request->getParam('text'), $context);

        return $response->withJson(['status' => 'success']);
    });
};
