<?php

namespace App\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterByEventAnnouncementCriteria
 * @package namespace App\Criteria;
 */
class FilterByEventAnnouncementCriteria extends AppCriteria implements CriteriaInterface
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $event_announcement_id = $this->request->get('event_announcement_id');
        if ($event_announcement_id) {
            $model = $model->where('event_announcement_id', $event_announcement_id);
        }
        return $model;
    }
}
