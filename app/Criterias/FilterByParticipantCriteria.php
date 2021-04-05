<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByTypeCriteria
 * @package namespace App\Criteria;
 */
class FilterByParticipantCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $participant_id = $this->request->get('participant_id');
        if ($participant_id) {
            $model = $model->where('participant_id', $participant_id);
        }
        return $model;
    }
}
