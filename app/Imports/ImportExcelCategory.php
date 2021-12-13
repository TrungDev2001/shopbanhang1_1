<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportExcelCategory implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Category([
            'name' => $row[0],
            'active' => $row[1],
            'parent_id' => $row[2],
            'slug' => $row[3],
        ]);
    }
}
