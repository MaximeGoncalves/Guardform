<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Form extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_night' => 'boolean'
    ];

    public function agents(): BelongsToMany
    {
        return $this->belongsToMany(Agent::class)->orderBy('name');
    }

    public function garde(): \Illuminate\Database\Eloquent\Relations\BelongsTo|Form
    {
        return $this->belongsTo(Guard::class, 'guard_id', 'id');
    }
}
