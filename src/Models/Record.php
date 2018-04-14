<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Record extends Model
{
    protected $guarded = [];
    protected $table = 'record';
    public $timestamps = false;
    public function jugador() {
      return $this->hasOne('\Models\Jugador');
    }
}
