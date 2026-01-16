<?php

namespace App\Exports;

use App\Models\Tracer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TracerExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Tracer::with('alumni')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama Alumni',
            'NIM',
            'Email',
            'Jenis Kelamin',
            'Program Studi',
            'Status',
            'Tanggal Mulai',
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->alumni->nama ?? 'N/A',
            $row->alumni->nim ?? 'N/A',
            $row->alumni->email ?? 'N/A',
            $row->alumni->jenis_kelamin ?? 'N/A',
            $row->alumni->program_studi ?? 'N/A',
            $row->status ?? 'N/A',
            $row->tanggal_mulai ? $row->tanggal_mulai->format('d/m/Y') : 'N/A',
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
}
