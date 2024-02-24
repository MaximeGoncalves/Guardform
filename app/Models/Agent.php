<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['fullname'];

    public function getFullnameAttribute(): string // notice that the attribute name is in CamelCase.
    {
        return $this->firstname . ' ' . $this->name;
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Form::class);
    }

    public function getStats(bool $is_night = false): void
    {
        $this->attributes['vsav'] = $this->vsavCount($is_night);
        $this->attributes['vsav2'] = $this->vsav2Count($is_night);
        $this->attributes['reserve'] = $this->reserveCount($is_night);
        $this->attributes['fptl'] = $this->fptlCount($is_night);
        $this->attributes['vli'] = $this->vliCount($is_night);
        $this->attributes['epa'] = $this->epaCount($is_night);
    }

    private function vsavCount(bool $is_night)
    {

        $query = $this->forms()
            ->with('garde')
            ->where(function ($query) use ($is_night) {
                $query
                    ->where('ca_vsav1', $this->id)
                    ->orWhere('cond_vsav1', $this->id)
                    ->orWhere('eq_vsav1', $this->id)
                    ->when(!$is_night, function ($query) {
                        $query
                            ->orWhere('ca_vsav2', $this->id)
                            ->orWhere('cond_vsav2', $this->id)
                            ->orWhere('eq_vsav2', $this->id);
                    });
            })
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function vsav2Count(bool $is_night)
    {
        $query = $this->forms()
            ->where(function ($query) {
                $query->where('ca_vsav2', $this->id)
                    ->orWhere('cond_vsav2', $this->id)
                    ->orWhere('eq_vsav2', $this->id);
            })
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function reserveCount(bool $is_night)
    {
        $query = $this->forms()
            ->where(function ($query) {
                $query->where('ca_vtu', $this->id)
                    ->orWhere('cond_vtu', $this->id)
                    ->orWhere('eq_vtu', $this->id)
                    ->orWhere('ca_vsr', $this->id)
                    ->orWhere('cond_vsr', $this->id)
                    ->orWhere('eq_vsr', $this->id);
            })
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function fptlCount(bool $is_night)
    {
        $query = $this->forms()
            ->where(function ($query) {
                $query->where('ca_fptl', $this->id)
                    ->orWhere('cond_fptl', $this->id)
                    ->orWhere('ce1_fptl', $this->id)
                    ->orWhere('ce2_fptl', $this->id)
                    ->orWhere('eq1_fptl', $this->id)
                    ->orWhere('eq2_fptl', $this->id);
            })
            ->where('is_night', $is_night);
        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function vliCount(bool $is_night)
    {
        $query = $this->forms()
            ->where('vli', $this->id)
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function epaCount(bool $is_night)
    {
        $query = $this->forms()
            ->with('garde')
            ->where('epa', $this->id)
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

}
