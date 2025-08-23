<?php

namespace App\Models;

use App\Enum\CourseLevel;
use App\Enum\CourseStatus;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\ProductInterface;
use Bavix\Wallet\Interfaces\ProductLimitedInterface;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Course extends Model implements HasMedia, ProductLimitedInterface
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    use InteractsWithMedia;
    use HasTags;
    use HasWallet;


    protected $guarded = ['id'];

    protected $casts = [
        'status' => CourseStatus::class,
        'level' => CourseLevel::class,
        'learn_goals' => 'array',
        'requirements' => 'array',
    ];

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
        return [__('Purchase access to the course: :course', ['course' => $this->title])];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'course_id')->orderBy('order');
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function canBuy(Customer $customer, int $quantity = 1, bool $force = false): bool
    {
        // Check if the course is available for purchase
        return !$customer->paid($this);
    }

    public function getThumbnailsAttribute(): ?string
    {
        return $this->getFirstMediaUrl('thumbnails');
    }

    public function getPromotionalVideosAttribute(): ?string
    {
        return $this->getFirstMediaUrl('promotional_videos');
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'course_user_ratings')->withPivot('rating')->withTimestamps();
    }

    public function getAverageRatingAttribute()
    {
        return round($this->ratings()->avg('course_user_ratings.rating'), 1);
    }



public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'course_user_favorites');
}

public function isFavoritedBy(?User $user): bool
{
    if (!$user) {
        return false; // Not logged in
    }

    return $this->favoritedBy()
        ->where('user_id', $user->id)
        ->exists();
}

}
