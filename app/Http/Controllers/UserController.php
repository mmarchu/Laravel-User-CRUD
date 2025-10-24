<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $user = User::all();

        try {
            return response()->json($user, 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to retrieve users', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        try{
            return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'User creation failed', 'error' => $e->getMessage()], 500);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user){
            return response()->json(['Message' => 'User not fond'], 404);
        }
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        try {
            return response()->json([
                'message' => 'User updated successfully',
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User update failed', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['Message' => 'User not fond'], 404);
        }

        $user->delete();
        try {
            return response()->json([
            'message' => 'User deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User deletion failed', 'error' => $e->getMessage()], 500);
        }
    }
}
