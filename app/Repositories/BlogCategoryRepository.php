<?php

namespace App\Repositories;

use App\Model\BlogCategories as Model;

/**
 * Class BlogcategoryRepository.
 */
class BlogCategoryRepository extends CoreRepository
{
    public function getEdit($id) 
    {
        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {
            
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);
        
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;
    }
    

    public function getAllWithPaginate ($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }


    /**
     * @return string
     *  Return the model
     */
    public function getModelClass()
    {
        return Model::class;
    }

}

