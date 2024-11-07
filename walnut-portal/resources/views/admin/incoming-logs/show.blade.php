@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Incoming Log Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Log Information</h5>
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $incomingLog->id }}</dd>

                <dt class="col-sm-3">Source</dt>
                <dd class="col-sm-9">{{ $incomingLog->source }}</dd>

                <dt class="col-sm-3">Title</dt>
                <dd class="col-sm-9">{{ $incomingLog->title }}</dd>

                <dt class="col-sm-3">Word Count</dt>
                <dd class="col-sm-9">{{ $incomingLog->word_count }}</dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $incomingLog->created_at }}</dd>
            </dl>

            @if($incomingLog->callbackLogs->isNotEmpty())
                <h5 class="mt-4">Related Callback Logs</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incomingLog->callbackLogs as $callbackLog)
                            <tr>
                                <td>{{ $callbackLog->id }}</td>
                                <td>
                                    <span class="badge bg-{{ $callbackLog->status === 'confirmed' ? 'success' : 'warning' }}">
                                        {{ $callbackLog->status }}
                                    </span>
                                </td>
                                <td>{{ $callbackLog->created_at }}</td>
                                <td>
                                    <a href="{{ route('callback-logs.show', $callbackLog) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('incoming-logs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection 
@endsection 