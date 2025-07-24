<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

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
    
    /**
     * Vérifier si l'utilisateur est admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    /**
     * Vérifier si l'utilisateur est un utilisateur normal
     */
    public function isUser()
    {
        return $this->role === 'user';
    }
    
    public function cart()
{
    return $this->hasOne(Cart::class);
}

public function getCartItemsCount()
{
    if (!$this->cart) {
        return 0;
    }
    
    return $this->cart->products()->sum('cart_product.quantity');
}

public function addresses()
{
    return $this->hasMany(Address::class);
}
}
