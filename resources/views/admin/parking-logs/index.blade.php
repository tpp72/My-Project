@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">Parking Logs</h1>
            <a class="btn btn-outline-light" href="{{ route('dashboard') }}">Back</a>
        </div>

        <div class="section-card">
            <div class="section-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-darkish mb-0">
                        <thead>
                            <tr>
                                <th style="width:110px">#</th>
                                <th>Lot</th>
                                <th>Vehicle</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td class="fw-semibold">LOG-{{ $log->id }}</td>
                                    <td>{{ $log->parking_lot_id ?? '-' }}</td>
                                    <td>{{ $log->vehicle_id ?? '-' }}</td>
                                    <td class="text-muted2">{{ $log->check_in_time ?? '-' }}</td>
                                    <td class="text-muted2">{{ $log->check_out_time ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted2 p-4">ไม่มีข้อมูล</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $logs->links() }}
        </div>
    </div>
@endsection
