<?php

namespace Lavalite\Package\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class ModulePublicCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('status', '=', 'Published');
        return $model;
    }
}
