<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['npm', 'nidn', 'nama'];

    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'krs', 'npm', 'kode_matakuliah');
    }
}
