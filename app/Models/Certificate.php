<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'materi_id',
        'progress',
        'file_path',
    ];

    /**
     * Relasi ke User (pemilik sertifikat)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Materi (materi yang diikuti)
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
