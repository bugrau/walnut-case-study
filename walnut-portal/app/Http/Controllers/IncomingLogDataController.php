<?php

namespace App\Http\Controllers;

use App\Models\IncomingLogData;
use Illuminate\Http\Request;

class IncomingLogDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logData = IncomingLogData::with('incomingLogs')
            ->latest()
            ->paginate(10);
        return view('admin.incoming-log-data.index', compact('logData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingLogData $incomingLogData)
    {
        return view('admin.incoming-log-data.show', compact('incomingLogData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
