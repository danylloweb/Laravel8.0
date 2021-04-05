<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByUserCriteria
 * @package namespace App\Criteria;
 */
class FilterByUserCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $user_id = $this->request->get('user_id');
        if ($user_id) {
            $model = $model->where('user_id', $user_id);
        }
        return $model;
    }
}
