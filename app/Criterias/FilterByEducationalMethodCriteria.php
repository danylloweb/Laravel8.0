<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEducationalMethodCriteria
 * @package namespace App\Criteria;
 */
class FilterByEducationalMethodCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $educational_method_id = $this->request->get('educational_method_id');
        if ($educational_method_id) {
            $model = $model->where('educational_method_id', $educational_method_id);
        }
        return $model;
    }
}
