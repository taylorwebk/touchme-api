<?php
namespace Controllers;

use \Models\Jugador;
use \Models\Record;
use \Models\Utils;
use \Models\Response;

class MainC
{
  public static function addPlayer($data) {
    $fields = ['nombres', 'correo'];
    if (!Utils::validateData($data, $fields)) {
      return Response::BadRequest(Utils::implodeFields($fields));
    }
    $player = Jugador::where('correo', $data['correo'])->first();
    if ($player) {
      return Response::Unauthorized('El correo ya fue registrado', 'Parece que ya han jugado con este correo antes');
    }
    $player = Jugador::create([
      'nombres' => $data['nombres'],
      'correo'  => $data['correo']
    ]);
    return Response::OK('creado', 'Genial... ya puedes jugar', $player);
  }
  public static function loginEmail($data) {
    $fields = ['correo'];
    if (!Utils::validateData($data, $fields)) {
      return Response::BadRequest(Utils::implodeFields($fields));
    }
    $player = Jugador::where('correo', $data['correo'])->first();
    if (!$player) {
      return Response::Unauthorized('El correo no esta registrado', 'Ups, registra tu nombre para poder jugar');
    }
    return Response::OK('creado', 'Genial... ya puedes jugar', $player);
  }
  public static function newRecord($data) {
    $fields = ['id', 'score'];
    if (!Utils::validateData($data, $fields)) {
      return Response::BadRequest(Utils::implodeFields($fields));
    }
    $player = Jugador::find($data['id']);
    if (!$player) {
      return Response::BadRequest('No existe el ID:' . $data['id']);
    }
    $record = $player->records()->create([
      'jugador_id'  => $player->id,
      'score'      => $data['score']
    ]);
    return Response::OK('todo OK', 'Genial, siempre puedes intentarlo otra vez', $record->id);
  }
  public static function top10() {
    $top = Record::orderBy('score', 'desc')->take(10)->get();
    $top = $top->map(function($item) {
      $player = Jugador::find($item->jugador_id);
      return [
        'nombres' => $player->nombres,
        'correo'  => $player->correo,
        'record'  => $item->score
      ];
    });
    return Response::OK('ok','ok',$top);
  }
  public static function topAll() {
    $top = Record::orderBy('score', 'desc')->get();
    $top = $top->map(function($item) {
      $player = Jugador::find($item->jugador_id);
      return [
        'nombres' => $player->nombres,
        'correo'  => $player->correo,
        'record'  => $item->score
      ];
    });
    return Response::OK('ok', 'ok', $top);
  }
}
