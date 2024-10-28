<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return response()->json([
            'status' => true,
            'message' => 'vendors retrieved successfully',
            'data' => $vendedores
        ], 200);
    }

    public function show($id)
    {
        $vendedores = Vendedor::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'vendors found successfully',
            'data' => $vendedores
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nome' => 'required|string|max:200',
            'CPF' => 'required|numeric| max:15',
            'Ano' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $vendedores = Vendedor::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'vendors created successfully',
            'data' => $vendedores
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
           'Nome' => 'required|string|max:200',
            'CPF' => 'required|numeric',
            'Ano' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $vendedores = Vendedor::findOrFail($id);
        $vendedores->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'vendors updated successfully',
            'data' => $vendedores
        ], 200);
    }

    public function destroy($id)
    {
        $vendedores = Vendedor::findOrFail($id);
        $vendedores->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'vendors deleted successfully'
        ], 204);
    }
}