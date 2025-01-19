<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
protected $table = 'pinjams';
    protected $fillable = [
        'user_id',
        'barang_id',
        'qty',
        'status',
    ];
    
    public function barang(){
        return $this->belongsTo(Barang::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
