@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h4 mb-3">Add Parking Slot</h1>

        <form method="POST" action="{{ route('admin.parking-slots.store') }}" class="section-card">
            @csrf
            <div class="section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Parking Lot</label>
                        <select name="parking_lot_id" class="form-select" required>
                            <option value="">-- select --</option>
                            @foreach ($lots as $lot)
                                <option value="{{ $lot->id }}">{{ $lot->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Slot Number</label>
                        <input name="slot_number" class="form-control" required placeholder="A-01">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="available">available</option>
                            <option value="occupied">occupied</option>
                            <option value="reserved">reserved</option>
                            <option value="maintenance">maintenance</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-red">Add Slot</button>
                    <a class="btn btn-outline-light" href="{{ route('dashboard') }}">Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection
