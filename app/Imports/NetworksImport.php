<?php

namespace App\Imports;

use App\Models\Network;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class NetworksImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Network([
            'name' => $row[0],
            'slug' => Str::slug($row[0]),
        ]);
    }
}
