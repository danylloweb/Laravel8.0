<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByMagistrateCriteria
 * @package namespace App\Criteria;
 */
class FilterByMagistrateCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $magistrate = $this->request->get('magistrate');
        if ($magistrate) {
            $model = $model->where('magistrate', $magistrate);
        }
        return $model;
    }
}
