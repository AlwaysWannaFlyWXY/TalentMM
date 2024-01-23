<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Industry extends Model
{
    use UUID;
    protected $table = 'industries';
    protected $primaryKey = 'id';
    protected $fillable = ['name','is_active','sort_order'];
}
