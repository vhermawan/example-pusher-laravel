<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\AuthRepository;
use App\Traits\HandlesQueryException;


class AuthController extends Controller
{
	use HandlesQueryException;

	protected $authRepository;

	public function __construct(
		AuthRepository $authRepository
	){
		$this->authRepository = $authRepository;
	}

	public function login(Request $request){
		$request->validate([
			'username' => 'required|string',
			'password' => 'required|string',
		]);

		$credentials = request(['username', 'password']);

		if(Auth::attempt($credentials)){
			$user = $request->user();
			$tokenResult = $user->createToken('Personal Access Token');
			$token = $tokenResult->token;
			$token->save();

			return response()->json([
				'user' => $user,
				'token' => $tokenResult->accessToken
			], Response::HTTP_OK);
		}else{
			return response()->json([
				'message' => 'Unauthorized'
			], 401);
		}
	}

	public function register(Request $request){
		try {
			$request->validate([
				'id_role' => 'required',
				'name' => 'required|string',
				'password' => 'required|string',
				'id_role' => 'required',
				'username' => 'required|string',
				'status' => 'required',
				'phone_number' => 'required',
			]);

			$user = $this->authRepository->createAccount(
			(object) [
				"id_role" => $request->id_role,
				"name" => $request->name,
				"password" => $request->password,
				"username" => $request->username,
				"status" => $request->status,
				"phone_number" => $request->phone_number,
				"created_by" => Auth::user()->id,
			]);

			return response()->json([
				'message' => 'success created user',
				'user' => $user
			], Response::HTTP_CREATED);
		} catch (ValidationException $e) {
			return response()->json([
				'message' => 'Validation Error',
				'errors' => $e->errors()
			], 422);
		} catch (QueryException $th) {
			return $this->handleQueryException($th);
		}
	}
}
