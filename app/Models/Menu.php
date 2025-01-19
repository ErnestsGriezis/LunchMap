<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $fillable = ['cafe_id', 'item_name', 'price', 'availability_date', 'photo'];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }
}
