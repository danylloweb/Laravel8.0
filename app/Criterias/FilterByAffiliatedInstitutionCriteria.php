<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByAffiliatedInstitutionCriteria
 * @package namespace App\Criteria;
 */
class FilterByAffiliatedInstitutionCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $affiliated_institution_id = $this->request->query->get('affiliated_institution_id');
        if ($affiliated_institution_id) {
            $model = $model->where('affiliated_institution_id', $affiliated_institution_id);
        }
        return $model;
    }
}
