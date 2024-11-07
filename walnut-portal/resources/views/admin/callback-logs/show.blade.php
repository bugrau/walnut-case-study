@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Callback Log Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Log Information</h5>
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $callbackLog->id }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-{{ $callbackLog->status === 'confirmed' ? 'success' : 'warning' }}">
                        {{ $callbackLog->status }}
                    </span>
                </dd>

                <dt class="col-sm-3">Result</dt>
                <dd class="col-sm-9">
                    <pre>{{ $callbackLog->result }}</pre>
                </dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $callbackLog->created_at }}</dd>

                <dt class="col-sm-3">Related Incoming Log</dt>
                <dd class="col-sm-9">
                    <a href="{{ route('incoming-logs.show', $callbackLog->incomingLog) }}">
                        {{ $callbackLog->incomingLog->title }}
                    </a>
                </dd>
            </dl>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('callback-logs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection 