<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;

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


    public function getGlobalStats(): void
    {
        $this->attributes['vsav_jour'] = $this->vsavCount(null, false)['count'];
        $this->attributes['vsav_nuit'] = $this->vsavCount(null, true)['count'];
        $this->attributes['vli_jour'] = $this->vliCount(null, false)['count'];
        $this->attributes['vli_nuit'] = $this->vliCount(null, true)['count'];
        $this->attributes['fptl_ca_jour'] = $this->cafptlCount(null, false)['count'];
        $this->attributes['fptl_ca_nuit'] = $this->cafptlCount(null, true)['count'];
        $this->attributes['fptl_cond_jour'] = $this->condfptlCount(null, false)['count'];
        $this->attributes['fptl_cond_nuit'] = $this->condfptlCount(null, true)['count'];
        $this->attributes['fptl_jour'] = $this->fptlCount(null, false)['count'];
        $this->attributes['fptl_nuit'] = $this->fptlCount(null, true)['count'];
        $this->attributes['epa_jour'] = $this->epaCount(null, false)['count'];
        $this->attributes['epa_nuit'] = $this->epaCount(null, true)['count'];
        $this->attributes['reserve_jour'] = $this->reserveCount(null, false)['count'];
        $this->attributes['reserve_nuit'] = $this->reserveCount(null, true)['count'];
    }

    public function getStats(Form|null $form): void
    {
        $this->attributes['vsav'] = $this->vsavCount($form?->id, $form?->is_night);
        $this->attributes['vsav2'] = $this->vsav2Count($form?->id, $form?->is_night);
        $this->attributes['reserve'] = $this->reserveCount($form?->id, $form?->is_night);
        $this->attributes['cafptl'] = $this->cafptlCount($form?->id, $form?->is_night);
        $this->attributes['condfptl'] = $this->condfptlCount($form?->id, $form?->is_night);
        $this->attributes['fptl'] = $this->fptlCount($form?->id, $form?->is_night);
        $this->attributes['vli'] = $this->vliCount($form?->id, $form?->is_night);
        $this->attributes['epa'] = $this->epaCount($form?->id, $form?->is_night);
        $this->attributes['secu'] = $this->secuCount($form?->id, $form?->is_night);
        $this->attributes['cafpt'] = $this->cafptCount($form?->id, $form?->is_night);
        $this->attributes['pharmacie'] = $this->pharmacieCount($form?->id,);
        $this->attributes['remise'] = $this->remiseCount($form?->id);
        $this->attributes['cuisine'] = $this->cuisineCount($form?->id);
    }

    private function vsavCount(int|null $id, bool $is_night)
    {

        $query = $this->forms()
            ->with('garde')
            ->when(!is_null($id), function ($query, $id) {
                $query->whereNot('forms.id', $id);
            })
            ->where('is_night', $is_night)
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
            });
        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function vsav2Count(int|null $id, bool|null $is_night)
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

    private function reserveCount(int|null $id, bool|null $is_night)
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

    private function cafptlCount(int|null $id, bool|null $is_night)
    {
        $query = $this->forms()
            ->whereNot('forms.id', $id)
            ->where(function ($query) {
                $query->where('ca_fptl', $this->id);
            })
            ->where('is_night', $is_night);
        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function condfptlCount(int|null $id, bool|null $is_night)
    {
        $query = $this->forms()
            ->whereNot('forms.id', $id)
            ->where(function ($query) {
                $query->where('cond_fptl', $this->id);
            })
            ->where('is_night', $is_night);
        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function fptlCount(int|null $id, bool|null $is_night)
    {
        $query = $this->forms()
            ->whereNot('forms.id', $id)
            ->where(function ($query) {
                $query->orWhere('ce1_fptl', $this->id)
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

    private function vliCount(int|null $id, bool|null $is_night)
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

    private function epaCount(int|null $id, bool|null $is_night)
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

    private function cafptCount(int|null $id, bool|null $is_night)
    {
        $query = $this->forms()
            ->with('garde')
            ->whereNot('forms.id', $id)
            ->where('ca_fpt', $this->id)
            ->where('is_night', $is_night);

        return [
            'count' => $query->count(),
            'last' => $query->get()->sortByDesc('garde.date')->first()?->garde->date
        ];
    }

    private function secuCount(int|null $id, bool|null $is_night)
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

    private function pharmacieCount(int|null $id)
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

    private function remiseCount(int|null $id)
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

    private function cuisineCount(int|null $id)
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
