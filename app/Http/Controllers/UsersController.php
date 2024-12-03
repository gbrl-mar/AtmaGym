<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Exception;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Users::all();
            return response()->json([
                "status" => true,
                "message" => "Get successful",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Log the incoming request data
            \Log::info('Incoming request data: ', $request->all());

            $request->validate([
                'username' => 'required',
                'email' => 'required|email',
                'birthdate' => 'required',
                'gender' => 'required',
                'password' => 'required',
            ]);

            $data = Users::create([
                'username' => $request->username,
                'email' => $request->email,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'password' => bcrypt($request->password),
                'weight' => $request->weight,
                'height' => $request->height,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Create successful",
                "data" => $data
            ], 201); // Use 201 for created
        } catch (Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage()); // Log the error
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = Users::find($id);

            if (!$data) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found"
                ], 404);
            }

            return response()->json([
                "status" => true,
                "message" => "Get successful",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Users::find($id);

            if (!$data) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found"
                ], 404);
            }

            $request->validate([
                'username' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'birthdate' => 'required',
                'gender' => 'required',
                'password' => 'required',
            ]);

            $data->update($request->all());

            return response()->json([
                "status" => true,
                "message" => "Update successful",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Users::find($id);

            if (!$data) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found"
                ], 404);
            }

            $data->delete();

            return response()->json([
                "status" => true,
                "message" => "Delete successful",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Login a user.
     */
    /**
 * Login a user.
 */
public function login(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Ambil email dan password dari permintaan
        $email = $request->input('email');
        $password = $request->input('password');

        // Cari pengguna berdasarkan email
        $user = Users::where('email', $email)->first();

        // Cek apakah pengguna ditemukan
        if ($user && password_verify($password, $user->password)) {
            return response()->json([
                "status" => true,
                "message" => "User found",
                "data" => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'birthdate' => $user->birthdate,
                    'gender' => $user->gender,
                    'weight' => $user->weight,
                    'height' => $user->height,
                    // Tambahkan atribut lain yang ingin Anda kembalikan
                ]
            ], 200);
        } else {
            // Jika pengguna tidak ditemukan atau password salah
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials"
            ], 401);
        }
    } catch (Exception $e) {
        return response()->json([
            "status" => false,
            "message" => "Something went wrong",
            "error" => $e->getMessage()
        ], 400);
    }
}

}
