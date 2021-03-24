<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterBySectionCriteria
 * @package App\Criterias
 */
class FilterBySectionCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $section_id = $this->request->get('section_id');
        if ($section_id) {
            $model = $model->where('section_id', $section_id);
        }
        return $model;
    }
}
