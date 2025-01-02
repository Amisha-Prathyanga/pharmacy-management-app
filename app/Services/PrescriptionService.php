<?php

namespace App\Services;

use App\Models\Prescription;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;

class PrescriptionService
{
    public function create(array $data)
    // {
    //     $images = [];
    //     if (!empty($data['images'])) {
    //         foreach ($data['images'] as $image) {
    //             $images[] = $image->store('prescriptions', 'public');
    //         }
    //     }

    //     return Prescription::create([
    //         'user_id' => Auth::id(),
    //         'note' => $data['note'] ?? null,
    //         'delivery_address' => $data['delivery_address'],
    //         'delivery_time' => $data['delivery_time'],
    //         'images' => $images,
    //     ]);
    // }

    {
        $images = [];
        
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                if ($image && $image->isValid()) {
                    // Generate a unique filename
                    $filename = uniqid() . '_' . $image->getClientOriginalName();
                    
                    // Store the image and get the path
                    $path = $image->storeAs('prescriptions', $filename, 'public');
                    
                    if ($path) {
                        $images[] = $path;
                    }
                }
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