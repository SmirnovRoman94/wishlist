<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Present extends Model
{
    use HasFactory;
    protected $guarded = false;


    public function holiday()
    {
        return $this->belongsTo(Holiday::class, 'holiday_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_presents', 'present_id', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_presents', 'present_id', 'tag_id');
    }
}
