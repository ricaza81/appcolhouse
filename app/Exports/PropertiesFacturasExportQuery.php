<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\PropertiesFacturas;

class PropertiesFacturasExportQuery implements FromQuery
{
    use Exportable;

    public function query()
    {
       return PropertiesFacturas::query();
    }
}
