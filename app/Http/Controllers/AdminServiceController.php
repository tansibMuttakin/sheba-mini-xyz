<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    public function index()
    {
        return Service::all();
    }
    public function store(Request $request)
    {
        return Service::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return $service;
    }
    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->noContent();
    }
    public function show($id)
    {
        return Service::findOrFail($id);
    }
}
