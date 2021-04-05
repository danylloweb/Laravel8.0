<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEndDateCriteria
 * @package namespace App\Criteria;
 */
class FilterByEndDateCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $end_date = $this->request->get('end_date');
        if ($end_date) {
            $model = $model->where('end_date', $end_date);
        }
        return $model;
    }
}
