<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Form::class);
    }
}
