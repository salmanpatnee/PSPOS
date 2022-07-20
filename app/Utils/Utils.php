<?php

namespace App\Utils;

use App\Models\Reference;
use Carbon\Carbon;

class Utils
{

    public function updateReferenceCount(string $type, int $businessId)
    {

        $reference = Reference::where('type',  $type)
            ->where('business_id', $businessId)
            ->first();

        if (!empty($reference)) {

            $reference->count++;
            $reference->save();

            return $reference->count;
        } else {
            $new_reference = Reference::create([
                'type'          => $type,
                'business_id'   => $businessId,
                'count'         => 1
            ]);

            return  $new_reference->count;
        }
    }

    public function generateReferenceNo(int $referenceCount)
    {

        $prefix = "PO";
        $ref_digits = str_pad($referenceCount, 4, 0, STR_PAD_LEFT);
        $ref_year   = Carbon::now()->year;
        $ref_month  = Carbon::now()->month;
        $ref_day    = Carbon::now()->day;

        return $prefix . $ref_year . $ref_month . $ref_day . '/' . $ref_digits;
    }
}
