<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByPromotingInstitutionCriteria
 * @package namespace App\Criteria;
 */
class FilterByPromotingInstitutionCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $promoting_institution_id = $this->request->get('promoting_institution_id');
        if ($promoting_institution_id) {
            $model = $model->where('promoting_institution_id', $promoting_institution_id);
        }
        return $model;

    }
}
