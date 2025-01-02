
    <title>Upload Prescription</title>
    <style>
        body {
            background-color: #111827;
            color: #e5e7eb;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #1f2937;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            margin-top: 5rem;
        }

        h2 {
            color: #e5e7eb;
            font-size: 1.8rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: #e5e7eb;
            font-weight: 500;
        }

        .form-control {
            background-color: #2d3748;
            color: #e5e7eb;
            border: 1px solid #4a5568;
            border-radius: 8px;
            padding: 0.75rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #4a5568;
            border-color: #3182ce;
            outline: none;
            box-shadow: 0 0 5px rgba(49, 130, 206, 0.5);
        }

        button {
            background-color: #3b82f6;
            color: #fff;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        button:active {
            background-color: #1d4ed8;
            transform: translateY(1px);
        }
    </style>
<body>

<div class="container">
    <h2>Upload Prescription</h2>
    <form action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="note" class="form-label">Note (optional):</label>
            <textarea name="note" id="note" class="form-control" rows="3">{{ old('note') }}</textarea>
        </div>

        <div class="form-group">
            <label for="delivery_address" class="form-label">Delivery Address:</label>
            <input type="text" name="delivery_address" id="delivery_address" class="form-control" value="{{ old('delivery_address') }}" required>
        </div>

        <div class="form-group">
            <label for="delivery_time" class="form-label">Delivery Time:</label>
            <select name="delivery_time" id="delivery_time" class="form-control" required>
                <option value="">Select a time slot</option>
                <option value="8-10 AM">8-10 AM</option>
                <option value="10-12 PM">10-12 PM</option>
                <option value="12-2 PM">12-2 PM</option>
                <option value="2-4 PM">2-4 PM</option>
                <option value="4-6 PM">4-6 PM</option>
            </select>
        </div>

        <div class="form-group">
            <label for="images" class="form-label">Upload Prescription Images (max: 5):</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*" required>
        </div>

        <button type="submit">Upload</button>
    </form>
</div>

</body>
</html>
