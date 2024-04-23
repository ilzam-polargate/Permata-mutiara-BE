<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    // Menampilkan semua data lead
    public function index()
    {
        $leads = Lead::all();
        return response()->json(['leads' => $leads], 200);
    }

    // Menyimpan data lead baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email',
            'message' => 'nullable|string',
            'leads_status' => 'nullable|string',
            'leads_note' => 'nullable|string',
            'leads_total_move' => 'nullable|integer',
            'path_referral' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $lead = Lead::create($request->all());

        return response()->json(['message' => 'Lead created successfully', 'lead' => $lead], 201);
    }

    // Menampilkan data lead berdasarkan ID
    public function show($id)
    {
        $lead = Lead::find($id);

        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }

        return response()->json(['lead' => $lead], 200);
    }

    // Mengupdate data lead berdasarkan ID
    public function update(Request $request, $id)
    {
        $lead = Lead::find($id);

        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email',
            'message' => 'nullable|string',
            'leads_status' => 'nullable|string',
            'leads_note' => 'nullable|string',
            'leads_total_move' => 'nullable|integer',
            'path_referral' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $lead->update($request->all());

        return response()->json(['message' => 'Lead updated successfully', 'lead' => $lead], 200);
    }

    // Menghapus data lead berdasarkan ID
    public function destroy($id)
    {
        $lead = Lead::find($id);

        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }

        $lead->delete();

        return response()->json(['message' => 'Lead deleted successfully'], 200);
    }
}
