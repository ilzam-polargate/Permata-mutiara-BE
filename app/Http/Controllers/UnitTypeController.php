<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UnitTypeController extends Controller
{
    public function index()
    {
        $unitTypes = UnitType::all();
        return response()->json(['unitTypes' => $unitTypes], 200);
    }

    public function show($id)
    {
        $unitType = UnitType::findOrFail($id);
        return response()->json(['unitType' => $unitType], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_title' => 'required|string',
            'unit_subtitle' => 'nullable|string',
            'unit_spec' => 'nullable|string',
            'is_active' => 'boolean',
            'unit_floorplan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data['created_by'] = Auth::id();

        // Set default value for is_active to true if not provided
        $data['is_active'] = isset($data['is_active']) ? $data['is_active'] : true;

        if ($request->hasFile('unit_floorplan')) {
            $imagePath = $request->file('unit_floorplan')->store('public/unit_floorplans');
            $data['unit_floorplan'] = $imagePath;
        }

        $unitType = UnitType::create($data);

        return response()->json(['message' => 'Unit type created successfully', 'unitType' => $unitType], 201);
    }

    public function update(Request $request, $id)
    {
        $unitType = UnitType::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'unit_title' => 'required|string',
            'unit_subtitle' => 'nullable|string',
            'unit_spec' => 'nullable|string',
            'is_active' => 'boolean',
            'unit_floorplan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data['updated_by'] = Auth::id();

        // Set default value for is_active to true if not provided
        $data['is_active'] = isset($data['is_active']) ? $data['is_active'] : true;

        if ($request->hasFile('unit_floorplan')) {
            // Delete existing floorplan
            if ($unitType->unit_floorplan) {
                Storage::delete($unitType->unit_floorplan);
            }
            $imagePath = $request->file('unit_floorplan')->store('public/unit_floorplans');
            $data['unit_floorplan'] = $imagePath;
        }

        $unitType->update($data);

        return response()->json(['message' => 'Unit type updated successfully', 'unitType' => $unitType], 200);
    }

    public function destroy($id)
    {
        $unitType = UnitType::findOrFail($id);

        // Delete associated floorplan
        if ($unitType->unit_floorplan) {
            Storage::delete($unitType->unit_floorplan);
        }

        $unitType->delete();

        return response()->json(['message' => 'Unit type deleted successfully'], 200);
    }
}
