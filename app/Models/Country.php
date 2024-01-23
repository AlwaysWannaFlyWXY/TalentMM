<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{

    use UUID;
    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
