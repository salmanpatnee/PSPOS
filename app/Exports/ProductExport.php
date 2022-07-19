<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromQuery, Responsable, WithHeadings, WithMapping
{
    use Exportable;

    protected $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    private $fileName = 'products.xlsx';

    public function headings(): array
    {
        return [
            'ID',
            'Product ID',
            'Name',
            'Category',
            'Brand',
            'Price',
            'VAT',
            'Units Sold',
            'Status',
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->product_id,
            $product->name,
            $product->category->name,
            ($product->brand_id) ? $product->brand->name : '',
            $product->price,
            $product->vat,
            $product->units_sold,
            $product->status,
        ];
    }

    public function query()
    {
        return Product::query()->whereKey($this->products);
    }
}
