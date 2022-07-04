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

    protected $students;

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

    public function map($student): array
    {
        return [
            $student->id,
            $student->class->name,
            $student->section->name,
            $student->name,
            $student->email,
            $student->address,
            $student->phone_number,
            // $student->created_at->toFormattedDateString(),
            // $student->updated_at->toFormattedDateString()
        ];
    }

    public function __construct(array $students)
    {
        $this->students = $students;
    }

    public function query()
    {
        return Student::query()->whereKey($this->students);
    }
}
