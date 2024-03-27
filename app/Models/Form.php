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

    public function scopeStats($id, $is_night)
    {
        $this->with('garde')
            ->when(!is_null($id), function ($query, $id) {
                $query->whereNot('forms.id', $id);
            });
    }

    public function caVsav1()
    {
        return $this->belongsTo(Agent::class, 'ca_vsav1', 'id');
    }

    public function caVsav2()
    {
        return $this->belongsTo(Agent::class, 'ca_vsav2', 'id');
    }

    public function caVsav3()
    {
        return $this->belongsTo(Agent::class, 'ca_vsav3', 'id');
    }

    public function condVsav1()
    {
        return $this->belongsTo(Agent::class, 'cond_vsav1', 'id');
    }

    public function condVsav2()
    {
        return $this->belongsTo(Agent::class, 'cond_vsav2', 'id');
    }

    public function condVsav3()
    {
        return $this->belongsTo(Agent::class, 'cond_vsav3', 'id');
    }

    public function eqVsav1()
    {
        return $this->belongsTo(Agent::class, 'eq_vsav1', 'id');
    }

    public function eqVsav2()
    {
        return $this->belongsTo(Agent::class, 'eq_vsav2', 'id');
    }

    public function eqVsav3()
    {
        return $this->belongsTo(Agent::class, 'eq_vsav3', 'id');
    }

    public function caVtu()
    {
        return $this->belongsTo(Agent::class, 'ca_vtu', 'id');
    }

    public function condVtu()
    {
        return $this->belongsTo(Agent::class, 'cond_vtu', 'id');
    }

    public function eqVtu()
    {
        return $this->belongsTo(Agent::class, 'eq_vtu', 'id');
    }

    public function caVsr()
    {
        return $this->belongsTo(Agent::class, 'ca_vsr', 'id');
    }

    public function condVsr()
    {
        return $this->belongsTo(Agent::class, 'cond_vsr', 'id');
    }

    public function eqVsr()
    {
        return $this->belongsTo(Agent::class, 'eq_vsr', 'id');
    }

    public function caFptl()
    {
        return $this->belongsTo(Agent::class, 'ca_fptl', 'id');
    }

    public function condFptl()
    {
        return $this->belongsTo(Agent::class, 'cond_fptl', 'id');
    }

    public function ce1Fptl()
    {
        return $this->belongsTo(Agent::class, 'ce1_fptl', 'id');
    }

    public function ce2Fptl()
    {
        return $this->belongsTo(Agent::class, 'ce2_fptl', 'id');
    }

    public function eq1Fptl()
    {
        return $this->belongsTo(Agent::class, 'eq1_fptl', 'id');
    }

    public function eq2Fptl()
    {
        return $this->belongsTo(Agent::class, 'eq2_fptl', 'id');
    }

    public function vli()
    {
        return $this->belongsTo(Agent::class, 'vli', 'id');
    }

    public function epa()
    {
        return $this->belongsTo(Agent::class, 'epa', 'id');
    }

    public function secu()
    {
        return $this->belongsTo(Agent::class, 'secu', 'id');
    }

    public function cuisine()
    {
        return $this->belongsTo(Agent::class, 'cuisine', 'id');
    }

    public function pharmacie()
    {
        return $this->belongsTo(Agent::class, 'pharmacie', 'id');
    }

    public function remise()
    {
        return $this->belongsTo(Agent::class, 'remise', 'id');
    }

    public function officier()
    {
        return $this->belongsTo(Agent::class, 'officier', 'id');
    }
    public function adjudant()
    {
        return $this->belongsTo(Agent::class, 'adjudant', 'id');
    }
    public function planton()
    {
        return $this->belongsTo(Agent::class, 'planton', 'id');
    }
}
