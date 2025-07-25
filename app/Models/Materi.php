<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'file',
        'video_file',
        'user_id',
    ];

    /**
     * Relasi ke User (Pelatih)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Feedback (Feedback-feedback milik materi ini)
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
