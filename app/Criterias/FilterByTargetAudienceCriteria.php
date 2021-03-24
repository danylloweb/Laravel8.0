<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEventsPlaceCriteria
 * @package namespace App\Criteria;
 */
class FilterByTargetAudienceCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $target_audience_id = $this->request->get('target_audience_id');
        if ($target_audience_id) {
            $model = $model->where('target_audience_id', $target_audience_id);
        }
        return $model;
    }
}
