<div class="container">
    <h2>Your Quotations</h2>
    @foreach ($quotations as $quotation)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Prescription: {{ $quotation->prescription->id }}</h5>
                <p><strong>Status:</strong> {{ ucfirst($quotation->status) }}</p>
                <form action="{{ route('quotations.updateStatus', $quotation) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" name="status" value="accepted" class="btn btn-success">Accept</button>
                    <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    @endforeach
</div>