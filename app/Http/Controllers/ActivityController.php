<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Activity;
use Exception;


class ActivityController extends Controller
{
    public function index()
    {
        try {
            $actividades = Activity::all();

            if ($actividades->isEmpty()) {
                return response()->json([
                    'mensaje' => 'No se encontraron actividades registradas.'
                ], 200);
            }

            return response()->json($actividades, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener las actividades.',
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

            $actividad = Activity::find($id);

            if (!$actividad) {
                return response()->json([
                    'mensaje' => 'Actividad no encontrada.'
                ], 404);
            }

            return response()->json($actividad, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener la actividad.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validar todos los datos
            $validator = Validator::make($request->all(), [
                'titulo' => 'required',
                'fecha' => 'required|date_format:Y-m-d',
                'ubicacion' => 'required|string|max:255',
                'duracion' => 'required|integer|min:1',
                'descripcion' => 'required|min:1',
                'publico' => 'required|string|in:General,Adulto,Infantil'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errores' => $validator->errors()
                ], 422);
            }

            // Crear la plantación
            $actividad = Activity::create($request->only([
                'titulo',
                'fecha',
                'ubicacion',
                'duracion',
                'descripcion',
                'publico'
            ]));


            return response()->json([
                'mensaje' => 'Actividad creada correctamente.',
                'data' => $actividad
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al crear la actividad.',
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

            $actividad = Activity::find($id);

            if (!$actividad) {
                return response()->json([
                    'mensaje' => 'Actividad no encontrada.'
                ], 404);
            }

            // Validar todos los datos
            $validator = Validator::make($request->all(), [
                'titulo' => 'required',
                'fecha' => 'required|date_format:Y-m-d',
                'ubicacion' => 'required|string|max:255',
                'duracion' => 'required|integer|min:1',
                'descripcion' => 'required|min:1',
                'publico' => 'required|string|in:General,Adulto,Infantil'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errores' => $validator->errors()
                ], 422);
            }

            // Actualizar los campos de la plantación
            $actividad->update($request->only([
                'titulo',
                'fecha',
                'ubicacion',
                'duracion',
                'descripcion',
                'publico'
            ]));

            return response()->json([
                'mensaje' => 'Actividad actualizada correctamente.',
                'data' => $actividad
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

            $actividad = Activity::find($id);

            if (!$actividad) {
                return response()->json([
                    'mensaje' => 'Actividad no encontrada.'
                ], 404);
            }
            $actividad->delete();
            return response()->json([
                'mensaje' => 'Actividad eliminada correctamente.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener la actividad.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}
