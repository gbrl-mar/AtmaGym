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
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'birthdate' => 'required|date',
                'gender' => 'required|string',
                'password' => 'required|string|min:8',
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
                'username' => 'string|max:255',
                'email' => 'email|unique:users,email,' . $id,
                'birthdate' => 'date',
                'gender' => 'string',
                'password' => 'string|min:8',
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
}