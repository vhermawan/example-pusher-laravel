<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Panen;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Repositories\PanenRepository;

class PanenController extends Controller
{

		protected $panenRepository;
    /**
     * Create a new controller instance.
     */
    public function __construct(Panen $panen, PanenRepository $panenRepository)
    {
        $this->model = $panen;
				$this->panenRepository = $panenRepository;
    }

    public function index()
    {
        $items = $this->model->get();
        return response(['data' => $items, 'status' => 200]);
    }

    public function store(Request $request){
			try {
				$request->validate([
					'id_kandang' => 'required',
					'tanggal_mulai' => 'required',
					'tanggal_panen' => 'required',
					'jumlah_panen' => 'required|integer',
					'bobot_total' => 'required|integer',
				]);	

				$panen = $this->panenRepository->createPanen(
				(object) [
					"id_kandang" => $request->id_kandang,
					"tanggal_mulai" => $request->tanggal_mulai,
					"tanggal_panen" => $request->tanggal_panen,
					"jumlah_panen" => $request->jumlah_panen,
					"bobot_total" => $request->bobot_total,
					"created_by" => Auth::user()->id,
				]);
				// event(new AddKandangEvent( $this->model->get() ));
				return response()->json([
					'message' => 'success created panen',
					'panen' => $panen
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
					'id_kandang' => 'required',
					'tanggal_mulai' => 'required',
					'tanggal_panen' => 'required',
					'jumlah_panen' => 'required|integer',
					'bobot_total' => 'required|integer',
				]);	

				$panen = $this->panenRepository->editPanen($id,(object) [
					"id_kandang" => $request->id_kandang,
					"tanggal_mulai" => $request->tanggal_mulai,
					"tanggal_panen" => $request->tanggal_panen,
					"jumlah_panen" => $request->jumlah_panen,
					"bobot_total" => $request->bobot_total,
					"updated_by" => Auth::user()->id,
				]);
				// event(new AddKandangEvent( $this->model->get() ));
				return response()->json([
					'message' => 'success update panen',
					'panen' => $panen
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
				$panen = $this->panenRepository->deletePanen($id);
				return response()->json([
					'message' => 'success delete panen',
					'panen' => $panen
				], Response::HTTP_OK);
			} catch (QueryException $th) {
				return $this->handleQueryException($th);
			}
		}
}
