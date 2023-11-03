<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Holiday extends Model
{
    use HasFactory;
    protected $guarded = false;



    public function presents()
    {
        return $this->hasMany(Present::class, 'holiday_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }

}
