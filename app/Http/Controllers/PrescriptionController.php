<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrescriptionRequest;
use App\Http\Requests\QuotationRequest;
use App\Models\Prescription;
use App\Models\Quotation;
use App\Services\PrescriptionService;
use App\Services\QuotationService;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    protected $service;

    public function __construct(PrescriptionService $service)
    {
        $this->service = $service;
    }

    public function store(StorePrescriptionRequest $request)
    {
        $this->service->create($request->validated());

        return response()->json(['message' => 'Prescription uploaded successfully!'], 201);
    }
}
