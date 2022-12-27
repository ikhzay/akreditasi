<?php

namespace App\Imports;

use App\Models\Instrument;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
            "jenis" => $row[2],
            "no_urut" => $row[3],
            "no_butir" => $row[4],
            "bobot" => $row[5],
            "element" => "<p>".$row[6]."</p>",
            "descriptor" => "<p>".$row[7]."</p>",
            "nilai" => $row[8],
            "skor" => $skor,
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
