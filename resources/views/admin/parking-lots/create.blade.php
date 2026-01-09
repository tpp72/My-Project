@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h4 mb-3">Create Parking Lot</h1>

        <form method="POST" action="{{ route('admin.parking-lots.store') }}" class="section-card">
            @csrf
            <div class="section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input name="name" class="form-control" required value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input name="location" class="form-control" value="{{ old('location') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Slots</label>
                        <input type="number" name="total_slots" class="form-control" min="1" required
                            value="{{ old('total_slots', 50) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Hourly Rate</label>
                        <input type="number" step="0.01" name="hourly_rate" class="form-control" min="0" required
                            value="{{ old('hourly_rate', 20) }}">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-red">Create</button>
                    <a class="btn btn-outline-light" href="{{ route('dashboard') }}">Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection
