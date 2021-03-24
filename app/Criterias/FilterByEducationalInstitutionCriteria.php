<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByTypeCriteria
 * @package namespace App\Criteria;
 */
class FilterByEducationalInstitutionCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $educational_institution_id = $this->request->get('educational_institution_id');
        if ($educational_institution_id) {
            $model = $model->where('educational_institution_id', $educational_institution_id);
        }
        return $model;
    }
}
