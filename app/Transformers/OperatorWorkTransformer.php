<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\OperatorWork;

class OperatorWorkTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(OperatorWork $model)
    {
        return [
            'id'=>$model->id,
            'submitted_by'=>$model->submitted_by,
            'submitted_when'=>$model->submitted_when,
            'site_code'=>$model->site_code,
            'activity'=>$model->activity,
            'uom'=>$model->uom,
            'block'=>$model->block,
            'task'=>$model->task,
            'start'=>$model->start,
            'end'=>$model->end,
            'mesin_id'=>$model->mesin_id,
            'fuel'=>$model->fuel,
            'check_by'=>$model->check_by,
            'check_when'=>$model->check_when,
            'verified_by'=>$model->verified_by,
            'verified_when'=>$model->verified_when,
            'duty'=>$model->duty,
            'reason'=>$model->reason
        ];
    }
}
