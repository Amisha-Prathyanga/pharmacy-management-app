<?php

namespace App\Services;

use App\Models\Prescription;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;

class QuotationService
{
    public function create(array $data, Prescription $prescription)
    {
        $total = array_reduce($data['drugs'], function ($carry, $drug) {
            return $carry + ($drug['quantity'] * $drug['price']);
        }, 0);

        return Quotation::create([
            'prescription_id' => $prescription->id,
            'drugs' => $data['drugs'],
            'total' => $total,
        ]);
    }

    public function updateStatus(Quotation $quotation, string $status)
    {
        $quotation->update(['status' => $status]);
    }
}