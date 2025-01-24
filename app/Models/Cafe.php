<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cafe extends Model
{
    use HasFactory;

    protected $table = 'cafes';
    protected $primaryKey = 'id_cafe';
    protected $fillable = ['name', 'location', 'id_user', 'description', 'photo', 'price_category', 'rating'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'cafe_id');
    }
}
