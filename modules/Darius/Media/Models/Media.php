<?php

namespace Darius\Media\Models;

use Darius\Media\Services\MediaFileService;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $casts = [
        'files' => 'json'
    ];

    protected static function booted()
    {
        static::deleting(function ($media) {
            MediaFileService::delete($media);
        });
    }

    public function getThumbAttribute()
    {
        return '/storage/' . $this->files[300];
    }
}
