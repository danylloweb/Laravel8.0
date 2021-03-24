<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByMagistrateTypesCriteria
 * @package namespace App\Criteria;
 */
class FilterByMagistrateTypesCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $magistrates = $this->request->get('magistrate_type');
        if ($magistrates) {
            $str = str_replace(",", "", $magistrates, $count);
            $magistrates = $count ? explode(",", $magistrates) : [$magistrates];
            $model = $model->whereIn('magistrate_type', $magistrates);
        }
        return $model;
    }
}
