<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function presents()
    {
        return $this->belongsToMany(Present::class, 'tag_presents', 'tag_id', 'present_id');
    }
}
