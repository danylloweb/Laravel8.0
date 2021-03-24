<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByOrganCriteria
 * @package namespace App\Criteria;
 */
class FilterByOrganCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $organ_id = $this->request->get('organ_id');
        if ($organ_id) {
            $str = str_replace(",", "", $organ_id, $count);
            $organ_id = $count ? explode(",", $organ_id) : [$organ_id];
            $model = $model->where('organ_id', $organ_id);
        }
        return $model;
    }
}
