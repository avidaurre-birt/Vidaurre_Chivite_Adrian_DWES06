<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Providers\UserService;
use Illuminate\Http\Request;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        //return  $users = $this->userService->getUsers();
        try {
            $users = $this->userService->getUsers();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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

            $user = $this->userService->getUserById($id);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {

            /* $validator = Validator::make($request->all([
                'nombre' => 'require',
                'password' => 'require'
            ]));

            if ($validator->fails()) {
                return response()->json([
                    'errores' => $validator->errors()
                ], 422);
            }*/

            $response = $this->userService->createUser($request);

            if (isset($response['error'])) {
                return response()->json($response, $response['status'] ?? 500);
            }
            return response()->json(
                $response,
                200
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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

            $response = $this->userService->deleteUser($id);

            if (isset($response['error'])) {
                return response()->json($response, $response['status'] ?? 500);
            }
            return response()->json(
                $response,
                200
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
