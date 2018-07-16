<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded = [];

    /**
     * get on thread path by id
     *
     * @return string
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }

    /**
     * set relationship with reply
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }
}
