<?php

namespace Spd\Advertising\Repositories;

use Spd\Advertising\Models\Advertising;

class AdvertisingRepo
{
    public function index()
    {
        return $this->query()->latest();
    }

    public function findById($id)
    {
        return $this->query()->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->query()->where('id', $id)->delete();
    }
    
    public function getAdvByLocation(string $location)
    {
        return $this->query()->where('location', $location);
    }

    private function query()
    {
        return Advertising::query();
    }
}
