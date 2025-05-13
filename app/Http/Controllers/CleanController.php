<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Clean;
use Exception;

class CleanController extends Controller
{
    public function index()
    {
        try {
            $limpiezas = Clean::all();

            if ($limpiezas->isEmpty()) {
                return response()->json([
                    'mensaje' => 'No se encontraron limpiezas registradas.'
                ], 200);
            }

            return response()->json($limpiezas, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener las limpiezas.',
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

            $limpieza = Clean::find($id);


            if (!$limpieza) {
                return response()->json([
                    'mensaje' => 'Limpieza no encontrada.'
                ], 404);
            }

            return response()->json($limpieza, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener la limpieza.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validar todos los datos
            $validator = Validator::make($request->all(), [
                'ubicacion' => 'required',
                'fecha' => 'required|date_format:Y-m-d',
                'cantidadRecogida_Kg' => 'required|integer|min:1',
                'participantes' => 'required|integer',
                'descripcion' => 'required|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errores' => $validator->errors()
                ], 422);
            }
            //Crear la limpieza
            $limpieza = Clean::create($request->only([
                'ubicacion',
                'fecha',
                'cantidadRecogida_Kg',
                'participantes',
                'descripcion'
            ]));

            return response()->json([
                'mensaje' => 'Limpieza creada correctamente.',
                'data' => $limpieza
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al crear la limpieza.',
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

            $limpieza = Clean::find($id);


            if (!$limpieza) {
                return response()->json([
                    'mensaje' => 'Limpieza no encontrada.'
                ], 404);
            }
            // Validar todos los datos
            $validator = Validator::make($request->all(), [
                'ubicacion' => 'required',
                'fecha' => 'required|date_format:Y-m-d',
                'cantidadRecogida_Kg' => 'required|integer|min:1',
                'participantes' => 'required|integer',
                'descripcion' => 'required|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errores' => $validator->errors()
                ], 422);
            }
            //Actualizar los campos de la limpieza
            $limpieza->update($request->only([
                'ubicacion',
                'fecha',
                'cantidadRecogida_Kg',
                'participantes',
                'descripcion'
            ]));

            return response()->json([
                'mensaje' => 'Limpieza actualizada correctamente.',
                'data' => $limpieza
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar la limpieza.',
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

            $limpieza = Clean::find($id);


            if (!$limpieza) {
                return response()->json([
                    'mensaje' => 'Limpieza no encontrada.'
                ], 404);
            }

            $limpieza->delete();
            return response()->json([
                'mensaje' => 'Limpieza eliminada correctamente.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al obtener la limpieza.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}
