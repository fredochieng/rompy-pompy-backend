<?php

namespace Modules\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelAvailability extends Model
{
    protected $fillable = ['ma_model_id', 'ma_availability_id'];

    protected $table = 'model_availabilities';
}
