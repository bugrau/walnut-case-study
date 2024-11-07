@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Log Data Details</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Payload</h5>
            <pre class="bg-light p-3">{{ json_encode($incomingLogData->payload, JSON_PRETTY_PRINT) }}</pre>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Inserted Items</h5>
            <pre class="bg-light p-3">{{ json_encode($incomingLogData->inserted, JSON_PRETTY_PRINT) }}</pre>
        </div>
    </div>

    @if($incomingLogData->incomingLogs->isNotEmpty())
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Related Incoming Logs</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Word Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incomingLogData->incomingLogs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->title }}</td>
                                <td>{{ $log->word_count }}</td>
                                <td>{{ $log->created_at }}</td>
                                <td>
                                    <a href="{{ route('incoming-logs.show', $log) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-3">
        <a href="{{ route('incoming-log-data.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection 