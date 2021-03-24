<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByAffiliateCriteria
 * @package namespace App\Criteria;
 */
class FilterByAffiliateCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $affiliate_id = $this->request->get('affiliate_id');
        if ($affiliate_id) {
            $model = $model->where('affiliate_id', $affiliate_id);
        }
        return $model;
    }
}
