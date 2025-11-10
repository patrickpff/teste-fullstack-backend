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
        'inauguration_date',
        'active',
        'region_id'
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
