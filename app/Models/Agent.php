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

    public function getStats(Form $form): void
    {
        $this->attributes['vsav'] = $this->vsavCount($form->id, $form->is_night);
        $this->attributes['vsav2'] = $this->vsav2Count($form->id, $form->is_night);
        $this->attributes['reserve'] = $this->reserveCount($form->id, $form->is_night);
        $this->attributes['fptl'] = $this->fptlCount($form->id, $form->is_night);
        $this->attributes['vli'] = $this->vliCount($form->id, $form->is_night);
        $this->attributes['epa'] = $this->epaCount($form->id, $form->is_night);
        $this->attributes['secu'] = $this->secuCount($form->id, $form->is_night);
        $this->attributes['pharmacie'] = $this->pharmacieCount($form->id,);
        $this->attributes['remise'] = $this->remiseCount($form->id,);
        $this->attributes['cuisine'] = $this->cuisineCount($form->id,);
    }

    private function vsavCount(int $id, bool $is_night)
    {

        $query = $this->forms()
            ->with('garde')
            ->whereNot('forms.id', $id)
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

    private function vsav2Count(int $id, bool $is_night)
    {
        $query = $this->forms()
            ->whereNot('forms.id', $id)
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

    private function reserveCount(int $id, bool $is_night)
    {
        $query = $this->forms()
            ->whereNot('forms.id', $id)
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

    private function fptlCount(int $id, bool $is_night)
    {
        $query = $this->forms()
            ->whereNot('forms.id', $id)
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

    private function vliCount(int $id, bool $is_night)
    {
        $query = $this->forms()
            ->whereNot('forms.id', $id)
            ->where('vli', $this->id)
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function epaCount(int $id, bool $is_night)
    {
        $query = $this->forms()
            ->with('garde')
            ->whereNot('forms.id', $id)
            ->where('epa', $this->id)
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function secuCount(int $id, bool $is_night)
    {
        $query = $this->forms()
            ->with('garde')
            ->whereNot('forms.id', $id)
            ->where('secu', $this->id)
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function pharmacieCount(int $id)
    {
        $query = $this->forms()
            ->with('garde')
            ->whereNot('forms.id', $id)
            ->where('pharmacie', $this->id);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function remiseCount(int $id)
    {
        $query = $this->forms()
            ->with('garde')
            ->whereNot('forms.id', $id)
            ->where('remise', $this->id);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function cuisineCount(int $id)
    {
        $query = $this->forms()
            ->with('garde')
            ->whereNot('forms.id', $id)
            ->where('cuisine', $this->id);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

}
