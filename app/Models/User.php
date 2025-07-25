<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\NewUserMail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel as FilamentPanel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use TomatoPHP\FilamentMediaManager\Traits\InteractsWithMediaFolders;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    use TwoFactorAuthenticatable;
    use InteractsWithMedia;
    use InteractsWithMediaFolders;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ["name", "email", "password"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function canAccessPanel(FilamentPanel $panel): bool
    {
//        if ($panel->getId() === "admin") {
//            return $this->hasRole(["Administrator", "Content Manager"]);
//        }
//
//        if ($panel->getId() === "content") {
//            return $this->hasRole("Content Manager");
//        }
//
//        return false;
         return true; //disable this in production
    }

    public static function booted(): void
    {
        static::created(function ($user) {
            if (app()->isLocal()) {
                Password::sendResetLink(["email" => $user->email]);
            }
        });
    }
}
