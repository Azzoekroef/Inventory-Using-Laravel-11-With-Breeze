<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
protected $table = 'barangs';
    protected $fillable = [
        'nama',
        'kelompok',
        'kategori',
        'qty',
        'spesifikasi',
    ];
    public function pinjam(){
        return $this->hasMany(Pinjam::class);
    }
}
