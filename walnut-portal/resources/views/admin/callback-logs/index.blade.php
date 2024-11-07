@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Callback Logs</h2>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Incoming Log</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>
                                    <span class="badge bg-{{ $log->status === 'confirmed' ? 'success' : 'warning' }}">
                                        {{ $log->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('incoming-logs.show', $log->incomingLog) }}">
                                        {{ $log->incomingLog->title }}
                                    </a>
                                </td>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('callback-logs.show', $log) }}" 
                                       class="btn btn-sm btn-info">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 