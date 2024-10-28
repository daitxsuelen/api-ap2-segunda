<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return response()->json([
            'status' => true,
            'message' => 'products retrieved successfully',
            'data' => $produtos
        ], 200);
    }

    public function show($id)
    {
        $produtos = Produto::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'products found successfully',
            'data' => $produtos
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preco' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $produtos = Produto::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'products created successfully',
            'data' => $produtos
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $produtos = Produto::findOrFail($id);
        $produtos->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'products updated successfully',
            'data' => $produtos
        ], 200);
    }

    public function destroy($id)
    {
        $customer = Produto::findOrFail($id);
        $customer->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'products deleted successfully'
        ], 204);
    }
}