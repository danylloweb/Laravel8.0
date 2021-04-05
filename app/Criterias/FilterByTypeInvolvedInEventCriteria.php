<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEventsPlaceCriteria
 * @package namespace App\Criteria;
 */
class FilterByTypeInvolvedInEventCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $type_involved_in_event_id = $this->request->get('type_involved_in_event_id');
        if ($type_involved_in_event_id) {
            $model = $model->where('type_involved_in_event_id', $type_involved_in_event_id);
        }
        return $model;
    }
}
