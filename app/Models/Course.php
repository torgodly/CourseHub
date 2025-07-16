<?php

namespace App\Models;

use Bavix\Wallet\Interfaces\ProductInterface;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Course extends Model implements HasMedia,ProductInterface
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    use InteractsWithMedia;
    use HasTags;
    use HasWallet;


    protected $guarded = ['id'];

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function getAmountProduct(\Bavix\Wallet\Interfaces\Customer $customer): int|string
    {
        return $this->price;
    }

    public function getMetaProduct(): ?array
    {
        return [
            'title' => 'Course: ' . $this->title,
            'description' => 'Purchase access to the course: ' . $this->title,
        ];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'course_id')->orderBy('order');
    }
}
