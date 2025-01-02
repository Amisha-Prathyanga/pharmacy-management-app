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

    public function create()
    {
        return view('prescriptions.create');
    }

    public function index()
    {
        $prescriptions = auth()->user()->prescriptions()->latest()->get();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function indexForPharmacy()
    {
        $prescriptions = Prescription::latest()->with('user')->get(); // Get all prescriptions with user details
        return view('pharmacy.prescriptions.index', compact('prescriptions'));
    }



    public function store(PrescriptionRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('dashboard')->with('success', 'Prescription uploaded successfully!');
    }
}
