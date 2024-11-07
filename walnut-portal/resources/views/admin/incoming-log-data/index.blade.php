@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Incoming Log Data</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created At</th>
                    <th>Inserted Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logData as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ count($data->inserted ?? []) }}</td>
                        <td>
                            <a href="{{ route('incoming-log-data.show', $data) }}" class="btn btn-sm btn-info">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $logData->links() }}
</div>
@endsection 