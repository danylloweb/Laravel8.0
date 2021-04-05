<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByNatureActionCriteria
 * @package namespace App\Criteria;
 */
class FilterByNatureActionCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $nature_action_id = $this->request->get('nature_action_id');
        if ($nature_action_id) {
            $model = $model->where('nature_action_id', $nature_action_id);
        }
        return $model;
    }
}
