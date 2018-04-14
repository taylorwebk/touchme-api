<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Controllers\MainC;

$app->get('/', function(Request $req, Response $res) {
  return $res->withJson("Touch Me API");
});
$app->post('/player', function(Request $req, Response $res) {
  $result = MainC::addPlayer($req->getParsedBody());
  return $res->withJson($result);
});
$app->post('/email', function(Request $req, Response $res) {
  $result = MainC::loginEmail($req->getParsedBody());
  return $res->withJson($result);
});
$app->post('/record', function(Request $req, Response $res) {
  $result = Mainc::newRecord($req->getParsedBody());
  return $res->withJson($result);
});
$app->get('/top', function(Request $req, Response $res) {
  $result = MainC::top10();
  return $res->withJson($result);
});
$app->get('/all', function(Request $req, Response $res) {
  $result = MainC::topAll();
  return $res->withJson($result);
});