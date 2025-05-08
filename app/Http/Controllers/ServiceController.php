<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $service = Service::paginate(10);
            return response()->json($service, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }
    }

    public function show(Service $service)
    {
        try {
            return response()->json($service, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 200);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:services',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        try {
            $service = Service::create($validated);
            return response()->json($service, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }

    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('services')->ignore($service->id),
            ],
            'category' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        try {
            $service->update($validated);
            return response()->json($service, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }

    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return response()->noContent();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }
    }
}
