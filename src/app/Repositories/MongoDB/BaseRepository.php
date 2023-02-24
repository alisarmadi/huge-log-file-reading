<?php

namespace App\Repositories\MongoDB;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\BSON\UTCDateTime;

class BaseRepository
{
    protected Model $model;
    /**
     * BaseRepository constructor.
     * @param string $model
     */
    public function __construct(string $model)
    {
        $this->model = new $model();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model
            ->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return Model
     */
    public function update(array $data, $id): Model
    {
        $item = $this->findById($id);
        if (isset($item->id)){
            $item->update($data);
        }
        return $item;
    }

    /**
     * @param $id
     * @return Model
     */
    public function delete($id): Model
    {
        $item = $this->findById($id);
        if (isset($item->id)){
            $item->delete();
        }
        return $item;
    }

    /**
     * @param $id
     * @return Model
     */
    public function findById($id): Model
    {
        return $this->model
            ->where('_id', $id)
            ->first();
    }

    public function createMany($items)
    {
        foreach ($items as $key => $item) {
            $items[$key]['created_at'] = new UTCDateTime(Carbon::now());
            $items[$key]['updated_at'] = new UTCDateTime(Carbon::now());
        }
        $this->model->raw(function ($collection) use ($items) {
            return $collection->insertMany($items);
        });
    }
}
