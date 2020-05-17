<?php

namespace App\Repositories;

use App\Model\BlogPosts as Model;

/**
 * Class BlogcategoryRepository.
 */
class BlogPostRepository extends CoreRepository
{
   
    /**
     * @return string
     *  Return the model
     */
    protected function getModelClass()
    {
        return Model::class;
    }

}
