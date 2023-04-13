<?php

namespace App\Exports;

use App\Models\Place;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlacesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Place::all();
    }
}
