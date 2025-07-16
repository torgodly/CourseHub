<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Section extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
