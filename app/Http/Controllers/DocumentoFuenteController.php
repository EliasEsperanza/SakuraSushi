<?php

namespace App\Http\Controllers;
use App\Models\DocumentoFuente;

use Illuminate\Http\Request;

class DocumentoFuenteController extends Controller
{
    public function index()
    {
        $documentos = DocumentoFuente::all();
        return view('documento_fuentes.index', compact('documentos'));
    }

    public function create()
    {
        return view('documento_fuentes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string|max:255',
        ]);

        DocumentoFuente::create($validated);

        return redirect()->route('documento_fuentes.index')->with('success', 'Documento fuente creado con éxito.');
    }

    public function edit(DocumentoFuente $documentoFuente)
    {
        return view('documento_fuentes.edit', compact('documentoFuente'));
    }

    public function update(Request $request, DocumentoFuente $documentoFuente)
    {
        $validated = $request->validate([
            'tipo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $documentoFuente->update($validated);

        return redirect()->route('documento_fuentes.index')->with('success', 'Documento fuente actualizado con éxito.');
    }

    public function destroy(DocumentoFuente $documentoFuente)
    {
        $documentoFuente->delete();
        return redirect()->route('documento_fuentes.index')->with('success', 'Documento fuente eliminado con éxito.');
    }
}