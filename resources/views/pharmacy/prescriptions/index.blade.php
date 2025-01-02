<style>
    body {
        background-color: #111827;
        color: #e5e7eb;
    }

    .admin-dashboard {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .dashboard-header h2 {
        color: #f3f4f6;
    }

    .search-box input {
        background: #1f2937;
        border: 1px solid #374151;
        color: #e5e7eb;
        padding: 0.5rem 1rem;
        border-radius: 6px;
    }

    .search-box input::placeholder {
        color: #6b7280;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #1f2937;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        border: 1px solid #374151;
    }

    .stat-card h3 {
        color: #9ca3af;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        font-size: 1.5rem;
        font-weight: 600;
        color: #f3f4f6;
        margin: 0;
    }

    .prescription-card {
        background: #1f2937;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        margin-bottom: 1.5rem;
        transition: transform 0.2s ease;
        border: 1px solid #374151;
    }

    .prescription-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
    }

    .prescription-header {
        padding: 1.5rem;
        border-bottom: 1px solid #374151;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #374151;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #e5e7eb;
    }

    .user-info h3 {
        color: #f3f4f6;
        margin: 0;
    }

    .user-info p {
        color: #9ca3af;
        margin: 0;
    }

    .prescription-details {
        padding: 1.5rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .detail-item {
        background: #111827;
        padding: 1rem;
        border-radius: 6px;
        border: 1px solid #374151;
    }

    .detail-label {
        color: #9ca3af;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        color: #f3f4f6;
        font-weight: 500;
    }

    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .image-container {
        position: relative;
        padding-bottom: 100%;
        border-radius: 6px;
        overflow: hidden;
        background: #111827;
        border: 1px solid #374151;
    }

    .prescription-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .prescription-image:hover {
        transform: scale(1.05);
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: #111827;
        border-top: 1px solid #374151;
        border-radius: 0 0 8px 8px;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-secondary {
        background: #374151;
        color: #e5e7eb;
        border: 1px solid #4b5563;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-pending {
        background: #422006;
        color: #fb923c;
        border: 1px solid #c2410c;
    }

    @media (max-width: 640px) {
        .prescription-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* Dark theme modal styles */
    .modal {
        background: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        background: #1f2937;
        border: 1px solid #374151;
    }

    .status-badge {
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
}

.status-accepted {
    background-color: #4caf50; /* Green */
    color: white;
}

.status-rejected {
    background-color: #f44336; /* Red */
    color: white;
}

.status-pending {
    background-color: #ff9800; /* Orange */
    color: white;
}

</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="admin-dashboard">
    <div class="dashboard-header">
        <h2 class="text-2xl font-bold">Prescription Management Admin </h2>
        <div class="search-box">
            <input type="text" placeholder="Search prescriptions..." class="border rounded px-3 py-2">
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Prescriptions</h3>
            <p>{{ $prescriptions->count() }}</p>
        </div>
        <div class="stat-card">
            <h3>Pending Quotations</h3>
            <p>{{ $prescriptions->where('status', 'pending')->count() }}</p>
        </div>
        <div class="stat-card">
            <h3>Active Users</h3>
            <p>{{ $prescriptions->unique('user_id')->count() }}</p>
        </div>
    </div>

    @foreach ($prescriptions as $prescription)
        <div class="prescription-card">
            <div class="prescription-header">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($prescription->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-semibold">{{ $prescription->user->name }}</h3>
                        <p>{{ $prescription->user->email }}</p>
                    </div>
                </div>
                @if($prescription->quotations->isNotEmpty())
                @php
                    $quotation = $prescription->quotations->first(); // Get the first quotation if available
                @endphp
                <span class="status-badge 
                    @if($quotation->status === 'accepted') 
                        status-accepted
                    @elseif($quotation->status === 'rejected') 
                        status-rejected
                    @else
                        status-pending
                    @endif
                ">
                    {{ ucfirst($quotation->status) }} Quotation
                </span>
                @else
                    <span class="status-badge status-pending">
                        No Quotation
                    </span>

                    <!-- Show the button only if there is no quotation -->
                    <div class="actions">
                        <a href="{{ route('quotations.create', $prescription) }}" class="btn btn-primary">
                            Prepare Quotation
                        </a>
                    </div>
                @endif
            </div>

            <div class="prescription-details">
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Delivery Address</div>
                        <div class="detail-value">{{ $prescription->delivery_address }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Delivery Time</div>
                        <div class="detail-value">{{ $prescription->delivery_time }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Submitted On</div>
                        <div class="detail-value">{{ $prescription->created_at->format('M d, Y H:i') }}</div>
                    </div>
                </div>

                @if($prescription->note)
                    <div class="detail-item" style="margin-bottom: 1.5rem;">
                        <div class="detail-label">Customer Note</div>
                        <div class="detail-value">{{ $prescription->note }}</div>
                    </div>
                @endif

                <div class="detail-label">Prescription Images</div>
                <div class="images-grid">
                    @foreach ($prescription->images as $image)
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 class="prescription-image" 
                                 alt="Prescription Image"
                                 onclick="openImagePreview('{{ asset('storage/' . $image) }}')">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
</x-app-layout>

<script>
    function openImagePreview(imageSrc) {
        let modal = document.getElementById('imagePreviewModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'imagePreviewModal';
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.95);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                padding: 2rem;
                cursor: pointer;
            `;
            document.body.appendChild(modal);
        }

        modal.innerHTML = `
            <img src="${imageSrc}" 
                 style="max-width: 90%; max-height: 90vh; object-fit: contain; cursor: default;"
                 onclick="event.stopPropagation()">
        `;

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        modal.onclick = function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        };
    }
</script>