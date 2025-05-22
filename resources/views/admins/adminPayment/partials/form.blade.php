<div class="form-group">
    <label for="patient_id">Patient</label>
    <select name="patient_id" class="form-control" required>
        @foreach($patients as $patient)
            <option value="{{ $patient->id }}" {{ isset($payment) && $payment->patient_id == $patient->id ? 'selected' : '' }}>
                {{ $patient->patient_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="item">Item Purchased</label>
    <input type="text" name="item" id="item" class="form-control" required>
</div>

<div class="form-group">
    <label for="amount">Amount</label>
    <input type="number" name="amount" step="0.01" class="form-control" value="{{ old('amount', $payment->amount ?? '') }}" required>
</div>

<div class="form-group">
    <label for="payment_method">Payment Method</label>
    <select name="payment_method" class="form-control" required>
        @foreach(['Credit Card', 'Debit Card', 'Cash', 'Insurance', 'Online Payment'] as $method)
            <option value="{{ $method }}" {{ isset($payment) && $payment->payment_method == $method ? 'selected' : '' }}>
                {{ $method }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="payment_status">Payment Status</label>
    <select name="payment_status" class="form-control" required>
        @foreach(['Pending', 'Completed', 'Failed', 'Refunded'] as $status)
            <option value="{{ $status }}" {{ isset($payment) && $payment->payment_status == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>
