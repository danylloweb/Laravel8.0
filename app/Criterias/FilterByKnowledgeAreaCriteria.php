<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByTypeCriteria
 * @package namespace App\Criteria;
 */
class FilterByKnowledgeAreaCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $knowledge_area_id = $this->request->get('knowledge_area_id');
        if ($knowledge_area_id) {
            $model = $model->where('knowledge_area_id', $knowledge_area_id);
        }
        return $model;
    }
}
