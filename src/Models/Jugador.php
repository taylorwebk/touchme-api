<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Jugador extends Model
{
    protected $guarded = [];
    protected $table = 'jugador';
    public $timestamps = false;
    public function records() {
      return $this->hasMany('\Models\Record');
    }
}
