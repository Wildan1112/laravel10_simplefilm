<?php

namespace App\Imports;

use App\Models\Type;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class TypesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Type([
            'name' => $row[0],
            'slug' => Str::slug($row[0]),
        ]);
    }
}
