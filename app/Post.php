<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Post extends Model
{
    use Sluggable;


    protected $fillable = [
        'title', 'body', 'iframe', 'image', 'user_id'
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGetExcerptAttribute()
    {
        return Str::limit($this->body,140);
        //return substr($this->body, 0, 140); <- también se puede usar así, esto es PHP puro
    }

    public function getGetImageAttribute()
    {
        if ($this->image) {
            # code...
            return url("storage/$this->image");
        }
    }
}
