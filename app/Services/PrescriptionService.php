<?php

namespace App\Services;

use App\Models\Prescription;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;

class PrescriptionService
{
    public function create(array $data)
    {
        $images = [];
        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $images[] = $image->store('prescriptions', 'public');
            }
        }

        return Prescription::create([
            'user_id' => Auth::id(),
            'note' => $data['note'] ?? null,
            'delivery_address' => $data['delivery_address'],
            'delivery_time' => $data['delivery_time'],
            'images' => $images,
        ]);
    }
}