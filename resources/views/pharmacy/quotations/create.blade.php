<style>
    .quotation-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background: #1f2937;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        border: 1px solid #374151;
        color: #e5e7eb;
    }

    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #374151;
    }

    .form-header h2 {
        color: #f3f4f6;
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-group label {
        display: block;
        color: #9ca3af;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    .drug-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 1rem;
        margin-bottom: 1rem;
        align-items: start;
        padding: 1rem;
        background: #111827;
        border-radius: 6px;
        border: 1px solid #374151;
        position: relative;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .input-label {
        font-size: 0.875rem;
        color: #9ca3af;
    }

    .form-control {
        width: 100%;
        padding: 0.625rem;
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 4px;
        color: #e5e7eb;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    .form-control::placeholder {
        color: #6b7280;
    }

    .remove-drug {
        background: #991b1b;
        color: #fee2e2;
        border: none;
        border-radius: 4px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .remove-drug:hover {
        background: #b91c1c;
    }

    .btn {
        padding: 0.625rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
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
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #374151;
    }

    .total-section {
        margin-top: 1rem;
        padding: 1rem;
        background: #111827;
        border-radius: 6px;
        border: 1px solid #374151;
    }

    .total-amount {
        font-size: 1.25rem;
        color: #f3f4f6;
        font-weight: 600;
    }
</style>

<div class="quotation-container">
    <div class="form-header">
        <h2>Prepare Quotation for Prescription</h2>
    </div>

    <form action="{{ route('quotations.store', $prescription) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Drugs & Medications</label>
            <div id="drugs-container">
                <div class="drug-row">
                    <div class="input-group">
                        <span class="input-label">Drug Name</span>
                        <input type="text" 
                               name="drugs[0][name]" 
                               placeholder="Enter drug name" 
                               class="form-control" 
                               required>
                    </div>
                    <div class="input-group">
                        <span class="input-label">Quantity</span>
                        <input type="number" 
                               name="drugs[0][quantity]" 
                               placeholder="Qty" 
                               class="form-control" 
                               required>
                    </div>
                    <div class="input-group">
                        <span class="input-label">Price (₹)</span>
                        <input type="number" 
                               name="drugs[0][price]" 
                               placeholder="0.00" 
                               class="form-control" 
                               step="0.01"
                               required>
                    </div>
                </div>
            </div>
            
            <button type="button" id="add-drug" class="btn btn-secondary">
                + Add Another Drug
            </button>
        </div>

        <div class="total-section">
            <div class="input-label">Total Amount</div>
            <div class="total-amount">₹ <span id="total">0.00</span></div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Submit Quotation</button>
            <button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
        </div>
    </form>
</div>

<script>
let drugIndex = 1;

function calculateTotal() {
    const totalElement = document.getElementById('total');
    let total = 0;
    
    document.querySelectorAll('.drug-row').forEach(row => {
        const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
        const price = parseFloat(row.querySelector('input[name*="[price]"]').value) || 0;
        total += quantity * price;
    });
    
    totalElement.textContent = total.toFixed(2);
}

function addDrugRow() {
    const container = document.getElementById('drugs-container');
    const newRow = document.createElement('div');
    newRow.className = 'drug-row';
    
    newRow.innerHTML = `
        <div class="input-group">
            <span class="input-label">Drug Name</span>
            <input type="text" 
                   name="drugs[${drugIndex}][name]" 
                   placeholder="Enter drug name" 
                   class="form-control" 
                   required>
        </div>
        <div class="input-group">
            <span class="input-label">Quantity</span>
            <input type="number" 
                   name="drugs[${drugIndex}][quantity]" 
                   placeholder="Qty" 
                   class="form-control" 
                   required>
        </div>
        <div class="input-group">
            <span class="input-label">Price (₹)</span>
            <input type="number" 
                   name="drugs[${drugIndex}][price]" 
                   placeholder="0.00" 
                   class="form-control" 
                   step="0.01"
                   required>
        </div>
        <button type="button" class="remove-drug" onclick="removeDrugRow(this)">×</button>
    `;
    
    container.appendChild(newRow);
    
    // Add event listeners to new inputs
    newRow.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });
    
    drugIndex++;
}

function removeDrugRow(button) {
    button.closest('.drug-row').remove();
    calculateTotal();
}

document.getElementById('add-drug').addEventListener('click', addDrugRow);

// Add event listeners to initial inputs
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', calculateTotal);
});
</script>