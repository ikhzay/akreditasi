<?php

namespace App\Imports;

use App\Models\Instrument;
use Maatwebsite\Excel\Concerns\ToModel;

class InstrumentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $skor = (($row[8])/4)*$row[5];
        return new Instrument([
            "jenis" => $row[1],
            "no_urut" => $row[2],
            "no_butir" => $row[3],
            "bobot" => $row[4],
            "element" => "<p>".$row[5]."</p>",
            "descriptor" => "<p>".$row[6]."</p>",
            "nilai" => $row[7],
            "skor" => $skor
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
