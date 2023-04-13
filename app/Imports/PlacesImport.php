<?php

namespace App\Imports;

use App\Models\Place;
use Maatwebsite\Excel\Concerns\ToModel;

class PlacesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Place([
            //
        ]);
    }
}
