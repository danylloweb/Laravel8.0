<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByNatureActionCriteria
 * @package namespace App\Criteria;
 */
class FilterByStartDateCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $start_date = $this->request->get('start_date');
        if ($start_date) {
            $model = $model->where('start_date', $start_date);
        }
        return $model;
    }
}
