<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;

class UserService
{

    protected $url;

    public function __construct()
    {
        $this->url = env('SPRINGBOOT_BASE_URL', 'http://localhost:8080/users');
    }

    public function getUsers()
    {
        $response = Http::get("{$this->url}/get");

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => 'No se pudo obtener los usuarios', 'status' => $response->status()];
        }
    }

    public function getUserById($id)
    {
        $response = Http::get("{$this->url}/get/{$id}");

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => 'No se pudo obtener el usuario', 'status' => $response->status()];
        }
    }


    public function createUser($request)
    {

        $response = Http::post("{$this->url}/save", $request);

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => 'No se pudo obtener el usuario', 'status' => $response->status()];
        }
    }

    public function deleteUser($id)
    {
        $response = Http::delete("{$this->url}/delete/{$id}");

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => 'No se ha podido eliminar el usuario', 'status' => $response->status()];
        }
    }
}
