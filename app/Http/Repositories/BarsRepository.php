<?php


namespace App\Http\Repositories;


use App\Models\Bar;

class BarsRepository extends Repository
{
    public function model()
    {
        // TODO: Implement model() method.
        return app(Bar::class);
    }
}
