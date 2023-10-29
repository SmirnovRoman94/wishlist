<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentImage extends Model
{
    use HasFactory;
    protected $guarded = false;


    public function getUrlAttribute()
    {
        return url('storage/' . $this->path);
    }

//    public static function cleareStorage() {
//        $images = PostImage::where('user_id', auth()->id())->whereNull('post_id')->get();
//        foreach ($images as $img) {
//            Storage::disk('public')->delete($img->path);
//            $img->delete();
//        }
//    }
}
