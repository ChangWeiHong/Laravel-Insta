<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        if (! $this->image) {
            $name = rawurlencode($this->title ?: 'Creator');

            return "https://ui-avatars.com/api/?name={$name}&background=e1306c&color=fff&size=256";
        }

        return '/storage/'.$this->image;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
