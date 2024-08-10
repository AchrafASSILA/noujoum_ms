<?php


namespace App\Exports;


use App\Models\Client\Client;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientsExport implements FromCollection
{
    public function collection()
    {
        return Client::all();
    }
}
