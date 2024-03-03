<?php

namespace App\Imports;

use App\Models\Genre;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class GenresImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Genre([
            'name' => $row[0],
            'slug' => Str::slug($row[0]),
        ]);
    }
}
