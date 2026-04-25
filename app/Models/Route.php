<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $fillable = ['number_route', 'start_stop', 'end_stop', 'price'];

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
