<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByOfficeCriteria
 * @package App\Criterias
 */
class FilterByOfficeCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $office_id = $this->request->get('office_id');
        if ($office_id) {
            $str = str_replace(",", "", $office_id, $count);
            $office_id = $count ? explode(",", $office_id) : [$office_id];
            $model = $model->whereIn('office_id', $office_id);
        }
        return $model;
    }
}
