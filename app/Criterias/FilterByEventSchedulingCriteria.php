<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEventSchedulingCriteria
 * @package namespace App\Criteria;
 */
class FilterByEventSchedulingCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $event_schedule_id = $this->request->get('event_schedule_id');
        if ($event_schedule_id) {
            $model = $model->where('event_schedule_id', $event_schedule_id);
        }
        return $model;
    }
}
