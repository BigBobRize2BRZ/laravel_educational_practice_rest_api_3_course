<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    use HasFactory;
    protected $table = 'buses';
    protected $fillable = ['registration_number', 'model', 'seats'];

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
