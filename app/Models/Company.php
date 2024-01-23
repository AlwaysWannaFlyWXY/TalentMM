<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use UUID;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'industry_id',
        'country_id',
        'state_id',
        'city_id',
        'description',
        'location',
        'no_of_offices',
        'website',
        'phone',
        'logo',
        'is_active',
        'is_featured',
        'map',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'linkedin_link',
        'youtube_link',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
