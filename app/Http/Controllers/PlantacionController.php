<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Plantacion;
use App\Models\Tree;
use Illuminate\Http\Request;
use Exception;

class PlantacionController extends Controller
{
    public function index()
    {
        try {
            $plantaciones = Plantacion::with('trees')->get();

            if ($plantaciones->isEmpty()) {
                return response()->json([
                    'mensaje' => 'No se encontraron plantaciones registradas.'
                ], 200);
            }

            return response()->json($plantaciones, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener las plantaciones.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Validar que el ID sea un número entero positivo
            if (!is_numeric($id) || intval($id) < 1) {
                return response()->json([
                    'error' => 'El ID proporcionado no es válido.'
                ], 400);
            }

            $plantacion = Plantacion::with('trees')->find($id);

            if (!$plantacion) {
                return response()->json([
                    'mensaje' => 'Plantación no encontrada.'
                ], 404);
            }

            return response()->json($plantacion, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener la plantación.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validar todo, incluyendo los árboles
            $validator = Validator::make($request->all(), [
                'fecha' => 'required|date_format:d-m-Y',
                'ubicacion' => 'required|string|max:255',
                'participantes' => 'required|integer|min:1',
                'trees' => 'required|array|min:1',
                'trees.*.especie' => 'required|string|max:100',
                'trees.*.cantidad' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errores' => $validator->errors()
                ], 422);
            }

            // Crear la plantación
            $plantacion = Plantacion::create($request->only(['fecha', 'ubicacion', 'participantes']));

            // Crear los árboles y asociarlos
            foreach ($request->input('trees') as $treeData) {
                $plantacion->trees()->create($treeData);
            }

            return response()->json([
                'mensaje' => 'Plantación y árboles creados correctamente.',
                'data' => $plantacion->load('trees')
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al crear la plantación.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar que el ID sea un número entero positivo
            if (!is_numeric($id) || intval($id) < 1) {
                return response()->json([
                    'error' => 'El ID proporcionado no es válido.'
                ], 400);
            }

            $plantacion = Plantacion::with('trees')->find($id);

            if (!$plantacion) {
                return response()->json([
                    'mensaje' => 'Plantación no encontrada.'
                ], 404);
            }

            // Validar todo, incluyendo los árboles
            $validator = Validator::make($request->all(), [
                'fecha' => 'required|date_format:d-m-Y',
                'ubicacion' => 'required|string|max:255',
                'participantes' => 'required|integer|min:1',
                'trees' => 'required|array|min:1',
                'trees.*.especie' => 'required|string|max:100',
                'trees.*.cantidad' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errores' => $validator->errors()
                ], 422);
            }

            // Actualizar los campos de la plantación
            $plantacion->update($request->only(['fecha', 'ubicacion', 'participantes']));

            // Actualizar los árboles asociados
            $plantacion->trees()->delete(); // Eliminar árboles existentes
            foreach ($request->input('trees') as $treeData) {
                $plantacion->trees()->create($treeData);
            }

            return response()->json([
                'mensaje' => 'Plantación y árboles actualizados correctamente.',
                'data' => $plantacion->load('trees')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar la plantación.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            // Validar que el ID sea un número entero positivo
            if (!is_numeric($id) || intval($id) < 1) {
                return response()->json([
                    'error' => 'El ID proporcionado no es válido.'
                ], 400);
            }

            $plantacion = Plantacion::with('trees')->find($id);

            if (!$plantacion) {
                return response()->json([
                    'mensaje' => 'Plantación no encontrada.'
                ], 404);
            }
            $plantacion->delete();
            return response()->json([
                'mensaje' => 'Plantación y árboles eliminados correctamente.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener la plantación.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}
