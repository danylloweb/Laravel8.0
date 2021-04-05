<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByTypeCriteria
 * @package namespace App\Criteria;
 */
class FilterByHasInstructorCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $has_instructor = $this->request->query->get('has_instructor');
        if ($has_instructor) {
            $model = $model->where('has_instructor', $has_instructor);
        }
        return $model;
    }
}
