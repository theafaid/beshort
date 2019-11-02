<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});
