<?php

namespace App\Exports;

use App\Models\sales;
use App\Models\customer;
use App\Models\detail_sales;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class saleExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        $penjualans = sales::latest()->get();

        $data = collect([]);

        foreach ($penjualans as $penjualan) {
            $pelanggan = customer::find($penjualan->customer_id);
            $detailPenjualan = detail_sales::where('sales_id', $penjualan->id)->get();

            foreach ($detailPenjualan as $detail) {
                $data->push([
                    'Nama Pelanggan' => $pelanggan->name,
                    'Alamat' => $pelanggan->address,
                    'Nomor Telepon' => $pelanggan->no_hp,
                    'Nama Produk' => $detail->product->name,
                    'Jumlah Produk' => $detail->amount,
                    'Subtotal' => $detail->sub_total,
                    'Total Harga' => $penjualan->total_price,
                    'Username' => $penjualan->user->name,
                    'Tanggal Penjualan' => \Carbon\Carbon::parse($penjualan->created_at)->setTimezone('Asia/Jakarta')->format('j F, Y H:i:s'),
                    // 'Bayar' => $penjualan->bayar,
                    // 'kembalian' => $penjualan->kembalian,
                ]);
            }
        }

        return $data;
    }


    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'Alamat',
            'Nomor Telepon',
            'Nama Produk',
            'Jumlah Produk',
            'Subtotal',
            'Total Harga',
            'Nama Petugas',
            'Tanggal Penjualan',
            // 'Bayar',
            // 'Kemb    alian'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ]
                ]);
            },
        ];
    }
}