<?php

namespace App\Imports;

use App\Models\Exerpaper;
use Maatwebsite\Excel\Concerns\ToModel;

class ExerpaperImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new Exerpaper([
        ]);
    }
}
