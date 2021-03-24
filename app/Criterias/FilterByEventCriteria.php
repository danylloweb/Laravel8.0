<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEventsPlaceCriteria
 * @package namespace App\Criteria;
 */
class FilterByEventCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $event_id = $this->request->get('event_id');
        if ($event_id) {
            $model = $model->where('event_id', $event_id);
        }
        return $model;
    }
}
