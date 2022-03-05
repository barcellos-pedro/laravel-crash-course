<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    /**
     * Check if the Post has already been liked by the user
     * @return bool
     */
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); // Collection method
    }

    /**
     * Many to one relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
