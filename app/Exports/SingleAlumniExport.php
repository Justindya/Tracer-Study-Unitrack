<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SingleAlumniExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    protected $alumniId;

    public function __construct($alumniId)
    {
        $this->alumniId = $alumniId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect([Alumni::with('tracers')->find($this->alumniId)]);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'NIM',
            'Email',
            'No. HP',
            'Angkatan',
            'Tahun Lulus',
            'Program Studi',
            'Jenis Kelamin',
            'Alamat',
            'Jumlah Tracer Study',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->nama,
            $row->nim,
            $row->email,
            $row->no_hp,
            $row->angkatan,
            $row->tahun_lulus,
            $row->program_studi,
            $row->jenis_kelamin,
            $row->alamat,
            $row->tracers->count(),
            $row->created_at->format('d/m/Y H:i:s'),
            $row->updated_at->format('d/m/Y H:i:s'),
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2EFDA']
                ]
            ],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        $alumni = Alumni::find($this->alumniId);
        return $alumni ? $alumni->nama : 'Alumni';
    }
}
