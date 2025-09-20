<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\EnrollmentStatus;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Traits\HasWallet;
use Cassandra\Type\UserType;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable implements Wallet, Customer, FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasWallet;
    use CanPay;
    use TwoFactorAuthenticatable;

    public function canAccessPanel(Panel $panel): bool
    {
        //based on type and the panel id
        return match ($panel->getId()) {
            'admin' => $this->is_admin,
            'trainer' => $this->is_trainer,
            default => false,
        };
    }

    protected $appends = ['avatar_url'];

    //is_admin
    public function getIsAdminAttribute(): bool
    {
        return $this->type === 'admin';
    }

    //is_trainer
    public function getIsTrainerAttribute(): bool
    {
        return $this->type === 'trainer';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'trainer_id');
    }


    //enroll in a course
    public function enroll(Course $course): Enrollment
    {
        return $this->enrollments()->create([
            'course_id' => $course->id,
            'status' => EnrollmentStatus::Pending->value,
            'price' => $course->price,
            'enrolled_at' => now(),
        ]);
    }


    public function favorites()
    {
        return $this->belongsToMany(Course::class, 'course_user_favorites');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'course_user_favorites');
    }

    public function ratedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user_ratings')
            ->withPivot('rating', 'comment')
            ->withTimestamps();
    }


    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : null;
    }
}
