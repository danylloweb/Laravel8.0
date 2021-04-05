<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByPlaceCriteria
 * @package namespace App\Criteria;
 */
class FilterByPlaceCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $place_id = $this->request->get('place_id');
        if ($place_id) {
            $model = $model->where('place_id', $place_id);
        }
        return $model;
    }
}
