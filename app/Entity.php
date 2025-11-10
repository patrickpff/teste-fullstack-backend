<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MedicalSpecialty;
use App\Region;

class Entity extends Model
{
    protected $fillable = [
        'corporate_name',
        'trade_name',
        'cnpj',
    ];

    public function medicalSpecialties()
    {
        return $this->belongsToMany(MedicalSpecialty::class, 'entity_medical_specialty');
    }

    public function region()
    {
        return $this->hasOne(Region::class);
    }
}
