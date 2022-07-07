<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements FromQuery, Responsable, WithHeadings, WithMapping
{
    use Exportable;

    protected $customers;

    public function __construct(array $customers)
    {
        $this->customers = $customers;
    }

    private $fileName = 'customers.xlsx';

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'mobile',
            'date_of_birth',
            'address',
            'previous_balance',
            'total_purchases',
            'last_purchase',
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->email,
            $customer->phone,
            $customer->mobile,
            $customer->date_of_birth->toFormattedDateString(),
            $customer->address,
            $customer->previous_balance,
            $customer->total_purchases,
            $customer->last_purchase->toFormattedDateString()
        ];
    }

    public function query()
    {
        return Customer::query()->whereKey($this->customers);
    }
}
