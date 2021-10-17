<?php

namespace Modules\Transaction\Dao\Repositories;

use Illuminate\Database\QueryException;
use Modules\Transaction\Dao\Models\So;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class SoRepository extends So implements CrudInterface
{
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable);
        return $this->select($list)->joinRelationship('has_customer');
    }

    public function saveRepository($request)
    {
        try {
            $activity = $this->create($request);
            return Notes::create($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function updateRepository($request, $code)
    {
        try {
            $update = $this->findOrFail($code);
            $update->update($request);
            return Notes::update($update);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($request)
    {
        try {
            is_array($request) ? $this->destroy(array_values($request)) : $this->destroy($request);
            return Notes::delete($request);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function singleRepository($code, $relation = false)
    {
        if ($relation) {
            return $this->with($relation)->findOrFail($code);
        }
        return $this->findOrFail($code);
    }

}
