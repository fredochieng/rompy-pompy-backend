<?php

namespace Modules\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $fillable = [];
    protected $table = 'models';

    /**
     * Set the categories
     *
     */
    // public function setServicesAttribute($value)
    // {
    //     $this->attributes['services'] = json_encode($value);
    // }

    // public function setAvailabilityAttribute($value)
    // {
    //     $this->attributes['availability'] = json_encode($value);
    // }

    /**
     * Get the categories
     *
     */
    public function getServicesAttribute($value)
    {
        return $this->attributes['services'] = json_decode($value);
    }

    public function getAvailabilityAttribute($value)
    {
        return $this->attributes['availability'] = json_decode($value);
    }

    /** Get all details of models */
    public static function GetAllModels()
    {

        $models = Models::select(
            'models.*',
            'models.id as m_id',
            'u.id as user_id',
            'u.name',
            'u.email',
            'co.country_name',
            'ct.city_name',
            'et.ethnicity',
            'bl.build'
        )
            ->leftJoin('users as u', 'models.m_model_id', 'u.id')
            ->leftJoin('countries as co', 'models.country_id', 'co.id')
            ->leftJoin('cities as ct', 'models.city_id', 'ct.id')
            ->leftJoin('ethnicities as et', 'models.ethnicity_id', 'et.id')
            ->leftJoin('build as bl', 'models.build_id', 'bl.id')
            ->get();

        return $models;
    }

    /** Generate model password */
    public static function GeneratePassword($length)
    {
        $alphanumeric_string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($alphanumeric_string), 0, $length);
    }
}
