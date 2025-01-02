<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotationController extends Controller
{
    protected $service;

    public function __construct(QuotationService $service)
    {
        $this->service = $service;
    }

    public function store(StoreQuotationRequest $request, Prescription $prescription)
    {
        $quotation = $this->service->create($request->validated(), $prescription);

        return response()->json(['message' => 'Quotation created successfully!', 'data' => $quotation], 201);
    }

    public function updateStatus(Request $request, Quotation $quotation)
    {
        $request->validate(['status' => 'required|in:accepted,rejected']);
        $this->service->updateStatus($quotation, $request->status);

        return response()->json(['message' => 'Status updated successfully!'], 200);
    }
}
