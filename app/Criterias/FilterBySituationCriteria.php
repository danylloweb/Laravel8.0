<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByStatusCriteria
 * @package namespace App\Criteria;
 */
class FilterBySituationCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $situation = $this->request->query->get('situation');
        if (is_numeric($situation)) {
            $model = $model->where('situation', $situation);
        }
        return $model;
    }
}
