<?php

namespace Modules\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelAvailability extends Model
{
    protected $fillable = ['ma_model_id', 'ma_availability_id'];

    protected $table = 'model_availabilities';

    public static function GetModelAvailabilities($ma_model_id)
    {
        $model_availabilities = ModelAvailability::select(
            'model_availabilities.*',
            'a.availability'
        )
            ->leftJoin('availability as a', 'model_availabilities.ma_availability_id', 'a.id')
            ->where('ma_model_id', $ma_model_id)
            ->get();

        return $model_availabilities;
    }
}
