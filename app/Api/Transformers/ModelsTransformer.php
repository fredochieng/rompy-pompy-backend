<?php

namespace App\Api\Transformers;

use App\Http\Controllers\Controller;
use App\Models\Api\Models\ModelAPI;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

class ModelsTransformer extends Controller
{
    public function transform(ModelAPI $model)
    {
        return [
            'title'   => $model['model_no'],
            'content' => $model['m_model_id'],
            'is_free' => $model['phone_no']
        ];
    }
}
