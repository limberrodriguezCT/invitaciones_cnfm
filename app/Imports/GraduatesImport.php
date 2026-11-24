<?php

namespace App\Imports;

use App\Models\Graduate;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class GraduatesImport implements ToModel
{
    public function model(array $row): Model|null
    {
        return new Graduate([
            //
        ]);
    }
}
