<style>
    :root {
        --bg-primary: #1a1f2e;
        --bg-secondary: #242c3d;
        --text-primary: #e2e8f0;
        --text-secondary: #94a3b8;
        --border-color: #374151;
        --accent-color: #3b82f6;
        --status-pending: #fbbf24;
        --status-accepted: #22c55e;
        --status-rejected: #ef4444;
    }
    
    .container {
        background-color: var(--bg-primary);
        color: var(--text-primary);
        padding: 1rem;
        min-height: 100vh;
    }
    
    .title {
        color: var(--text-primary);
        font-size: 1.5rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--accent-color);
    }
    
    .quotation-card {
        background-color: var(--bg-secondary);
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        padding: 1rem;
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 1rem;
        align-items: start;
    }
    
    .image-section {
        width: 150px;
    }
    
    .image-gallery {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .img-thumbnail {
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid var(--border-color);
    }
    
    .details-section {
        display: grid;
        gap: 0.5rem;
    }
    
    .prescription-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    [data-status="pending"] {
        background-color: var(--status-pending);
        color: #000;
    }
    
    [data-status="accepted"] {
        background-color: var(--status-accepted);
        color: #fff;
    }
    
    [data-status="rejected"] {
        background-color: var(--status-rejected);
        color: #fff;
    }
    
    .drug-table {
        width: 100%;
        font-size: 0.875rem;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .drug-table th, .drug-table td {
        padding: 0.5rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    
    .drug-table th {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--accent-color);
        font-weight: 500;
    }
    
    .actions-section {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }
    
    .accept {
        background-color: var(--status-accepted);
        color: white;
    }
    
    .reject {
        background-color: var(--status-rejected);
        color: white;
    }
    
    .user-info {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }
    
    .total-amount {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--accent-color);
        text-align: right;
        margin-top: 0.5rem;
    }
    </style>
    <x-app-layout>
        <x-slot name="header">
            
        </x-slot>
    <div class="container">
        <h2 class="title">Quotations</h2>
    
        @foreach ($quotations as $quotation)
            <div class="quotation-card">
                <!-- Left: Images -->
                <div class="image-section">
                    @foreach ($quotation->prescription->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Prescription" class="img-thumbnail">
                    @endforeach
                </div>
    
                <!-- Middle: Details and Drugs -->
                <div class="details-section">
                    <div class="prescription-header">
                        <div>
                            <div class="user-info">
                                👤 {{ $quotation->prescription->user->name }} | 
                                📝 #{{ $quotation->prescription->id }}
                            </div>
                            <small>📍 {{ $quotation->prescription->delivery_address }}</small>
                        </div>
                        <span class="status-badge" data-status="{{ strtolower($quotation->status) }}">
                            {{ ucfirst($quotation->status) }}
                        </span>
                    </div>
    
                    <table class="drug-table">
                        <thead>
                            <tr>
                                <th>Medication</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotation->drugs as $drug)
                                <tr>
                                    <td>{{ $drug['name'] }}</td>
                                    <td>{{ $drug['quantity'] }}</td>
                                    <td>${{ number_format($drug['price'], 2) }}</td>
                                    <td>${{ number_format($drug['quantity'] * $drug['price'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="total-amount">
                        Total: ${{ number_format($quotation->total, 2) }}
                    </div>
                </div>
    
                <!-- Right: Actions -->
                <div class="actions-section">
                    <form action="{{ route('quotations.updateStatus', $quotation) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" name="status" value="accepted" class="btn accept">✓ Accept</button>
                    </form>
                    <form action="{{ route('quotations.updateStatus', $quotation) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" name="status" value="rejected" class="btn reject">✕ Reject</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>