<?php

namespace Modules\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelServices extends Model
{
    protected $fillable = ['ms_model_id', 'ms_service_id'];

    protected $table = 'model_services';

    public static function GetModelServices($ms_model_id)
    {
        $model_services = ModelServices::select(
            'model_services.*',
            's.service'
        )
        ->leftJoin('services as s', 'model_services.ms_service_id', 's.id')
            ->where('ms_model_id', $ms_model_id)
            ->get();

        return $model_services;
    }
}
