{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="container">
    <h2>Your Prescriptions</h2>
    @if ($prescriptions->isEmpty())
        <p>No prescriptions uploaded yet.</p>
    @else
        <div class="list-group">
            @foreach ($prescriptions as $prescription)
                <div class="list-group-item">
                    <h5>Delivery Address: {{ $prescription->delivery_address }}</h5>
                    <p><strong>Delivery Time:</strong> {{ $prescription->delivery_time }}</p>
                    <p><strong>Note:</strong> {{ $prescription->note ?? 'N/A' }}</p>
                    <p><strong>Uploaded Images:</strong></p>
                    <div class="row">
                        @foreach ($prescription->images as $image)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail" alt="Prescription Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .prescriptions-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #1a1a1a;
        }

        .empty-state {
            background-color: #e7f3ff;
            padding: 1rem;
            border-radius: 0.5rem;
            color: #0066cc;
        }

        .prescriptions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(100%, 500px), 1fr));
            gap: 1.5rem;
        }

        .prescription-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .prescription-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #2563eb;
            color: white;
            padding: 1rem;
        }

        .card-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        .info-section {
            margin-bottom: 1.5rem;
        }

        .info-section:last-child {
            margin-bottom: 0;
        }

        .info-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-content {
            color: #1a1a1a;
            line-height: 1.5;
        }

        .images-section {
            padding: 1.5rem;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
        }

        .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 0.75rem;
        }

        .image-container {
            position: relative;
            padding-bottom: 100%;
            overflow: hidden;
            border-radius: 0.375rem;
            background: #e5e7eb;
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

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            padding: 2rem;
            cursor: pointer;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90vh;
            object-fit: contain;
            cursor: default;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: white;
            font-size: 2rem;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .prescriptions-grid {
                grid-template-columns: 1fr;
            }
            
            .images-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <div class="prescriptions-container">
        <h2 class="page-title">Your Prescriptions</h2>

        @if ($prescriptions->isEmpty())
            <div class="empty-state">
                No prescriptions uploaded yet.
            </div>
        @else
            <div class="prescriptions-grid">
                @foreach ($prescriptions as $prescription)
                    <div class="prescription-card">
                        <div class="card-header">
                            <h3 class="card-title">Prescription ID - {{$prescription->id}} Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="info-section">
                                <div class="info-label">Delivery Address</div>
                                <div class="info-content">{{ $prescription->delivery_address }}</div>
                            </div>
                            <div class="info-section">
                                <div class="info-label">Delivery Time</div>
                                <div class="info-content">{{ $prescription->delivery_time }}</div>
                            </div>
                            @if($prescription->note)
                                <div class="info-section">
                                    <div class="info-label">Note</div>
                                    <div class="info-content">{{ $prescription->note }}</div>
                                </div>
                            @endif
                        </div>
                        <div class="images-section">
                            <div class="info-label">Prescription Images</div>
                            <div class="images-grid">
                                @foreach ($prescription->images as $image)
                                    <div class="image-container">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             class="prescription-image"
                                             alt="Prescription Image"
                                             onclick="openModal('{{ asset('storage/' . $image) }}')">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal for image preview -->
    <div class="modal" id="imageModal" onclick="closeModal()">
        <span class="modal-close">&times;</span>
        <img src="" class="modal-content" id="modalImage" onclick="event.stopPropagation()">
    </div>

    <script>
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.classList.add('active');
            modalImg.src = imageSrc;
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</x-app-layout>