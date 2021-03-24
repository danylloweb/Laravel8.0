<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Repositories\UserRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends AppService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 20)
    {
        return $this->repository
            ->resetCriteria()
            ->pushCriteria(app(AppRequestCriteria::class))
            ->paginate($limit);
    }


}
