<?php
require __DIR__ . '/vendor/autoload.php';

use App\Controller\Book;
use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

Router::get('/', function () {
    (new Book())->indexAction();
});

Router::post('/create', (function (Request $req, Response $res) {
    (new Book())->createAction($req, $res);
}));

Router::post('/update', (function (Request $req, Response $res) {
    (new Book())->updateAction($req, $res);
}));

Router::get('/view/([0-9]*)', (function (Request $req, Response $res) {
    (new Book())->viewAction($req, $res);
}));

Router::get('/delete/([0-9]*)', (function (Request $req, Response $res) {
    (new Book())->deleteAction($req, $res);
}));

App::run();
