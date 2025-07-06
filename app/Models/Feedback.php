<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'content',
        'user_id',
        'materi_id',
    ];

    /**
     * Relasi ke User (pengirim feedback)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Materi (materi yang diberi feedback)
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
