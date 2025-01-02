<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrescriptionRequest;
use App\Http\Requests\QuotationRequest;
use App\Models\Prescription;
use App\Models\Quotation;
use App\Services\PrescriptionService;
use App\Services\QuotationService;
use RealRashid\SweetAlert\Facades\Alert;


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
        $prescriptions = Prescription::latest()->with('user')->get(); 
        return view('pharmacy.prescriptions.index', compact('prescriptions'));
    }



    public function store(PrescriptionRequest $request)
    {
        // $this->service->create($request->validated());

        // return redirect()->route('dashboard')->with('success', 'Prescription uploaded successfully!');

        $request->validate([
            'delivery_address' => 'required|string',
            'delivery_time' => 'required|string',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'required|image|max:20480', // 2MB max per image
            'note' => 'nullable|string',
        ]);
    
        try {
            $prescription = (new PrescriptionService())->create($request->all());
            Alert::success('Success', 'Prescription uploaded successfully');
            return redirect()->route('prescriptions.index')
                ->with('success', 'Prescription uploaded successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
