<?php

namespace App\Exports;

use App\PropertiesFacturas;
use Maatwebsite\Excel\Concerns\FromCollection;

class PropertiesFacturasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PropertiesFacturas::all();
    }
}
