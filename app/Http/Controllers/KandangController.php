<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Kandang;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Events\AddKandangEvent;
use App\Repositories\KandangRepository;

class KandangController extends Controller
{

		protected $kandangRepository;
    /**
     * Create a new controller instance.
     */
    public function __construct(Kandang $kandang, KandangRepository $kandangRepository)
    {
        $this->model = $kandang;
				$this->kandangRepository = $kandangRepository;
    }

    public function index()
    {
        $items = $this->model->get();
        return response(['data' => $items, 'status' => 200]);
    }

    public function store(Request $request){
			try {
				$request->validate([
					'nama_kandang' => 'required',
					'populasi_awal' => 'required',
					'alamat_kandang' => 'required|string',
				]);	

				$kandang = $this->kandangRepository->createKandang(
				(object) [
					"id_user" => Auth::user()->id,
					"nama_kandang" => $request->nama_kandang,
					"populasi_awal" => $request->populasi_awal,
					"alamat_kandang" => $request->alamat_kandang,
					"created_by" => Auth::user()->id,
				]);
				// event(new AddKandangEvent( $this->model->get() ));
				return response()->json([
					'message' => 'success created kandang',
					'kandang' => $kandang
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

		public function update(Request $request, $id){
			try {
				$request->validate([
					'nama_kandang' => 'required',
					'populasi_awal' => 'required',
					'alamat_kandang' => 'required|string',
				]);	

				$kandang = $this->kandangRepository->editKandang($id,(object) [
					"id_user" => Auth::user()->id,
					"nama_kandang" => $request->nama_kandang,
					"populasi_awal" => $request->populasi_awal,
					"alamat_kandang" => $request->alamat_kandang,
					"updated_by" => Auth::user()->id,
				]);
				// event(new AddKandangEvent( $this->model->get() ));
				return response()->json([
					'message' => 'success update kandang',
					'kandang' => $kandang
				], Response::HTTP_OK);
			} catch (ValidationException $e) {
				return response()->json([
					'message' => 'Validation Error',
					'errors' => $e->errors()
				], 422);
			} catch (QueryException $th) {
				return $this->handleQueryException($th);
			}
    }

		public function delete($id){
			try {
				$kandang = $this->kandangRepository->deleteKandang($id);
				return response()->json([
					'message' => 'success delete kandang',
					'kandang' => $kandang
				], Response::HTTP_OK);
			} catch (QueryException $th) {
				return $this->handleQueryException($th);
			}
		}
}
