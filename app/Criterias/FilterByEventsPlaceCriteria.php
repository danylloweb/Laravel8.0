<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEventsPlaceCriteria
 * @package namespace App\Criteria;
 */
class FilterByEventsPlaceCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $events_place_id = $this->request->get('events_place_id');
        if ($events_place_id) {
            $model = $model->where('events_place_id', $events_place_id);
        }
        return $model;
    }
}
