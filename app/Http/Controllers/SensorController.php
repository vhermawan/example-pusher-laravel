<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\AmoniakSensor;
use App\Models\SuhuKelembapanSensor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Repositories\AmoniakRepository;
use App\Repositories\SuhuKelembapanRepository;

class SensorController extends Controller
{

		protected $amoniakRepository;
		protected $suhuKelembapanRepository;
    /**
     * Create a new controller instance.
     */
    public function __construct(
      AmoniakSensor $amoniakSensor, 
      SuhuKelembapanSensor $suhuKelembapanSensor, 
      AmoniakRepository $amoniakRepository, 
      SuhuKelembapanRepository $suhuKelembapanRepository
    )
    {
      $this->modelAmoniak = $amoniakSensor;
      $this->modelSuhuKelembapanSensor = $suhuKelembapanSensor;
      $this->amoniakRepository = $amoniakRepository;
      $this->suhuKelembapanRepository = $suhuKelembapanRepository;
    }

    public function indexAmonia()
    {
        $items = $this->modelAmoniak->get();
        return response(['data' => $items, 'status' => 200]);
    }

		public function indexSuhuKelembapan()
    {
        $items = $this->modelSuhuKelembapanSensor->get();
        return response(['data' => $items, 'status' => 200]);
    }

    public function storeAmoniak(Request $request){
			try {
				$request->validate([
					'id_kandang' => 'required',
					'date' => 'required',
					'amoniak' => 'required',
				]);	

				$amoniak = $this->amoniakRepository->createAmoniak(
				(object) [
					"id_kandang" => $request->id_kandang,
					"date" => $request->date,
					"amoniak" => $request->amoniak,
				]);
				return response()->json([
					'message' => 'success created sensor amoniak',
					'amoniak' => $amoniak
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

		public function storeSuhuKelembapan(Request $request){
			try {
				$request->validate([
					'id_kandang' => 'required',
					'date' => 'required',
					'suhu' => 'required',
					'kelembapan' => 'required',
				]);	

				$suhuKelembapan = $this->suhuKelembapanRepository->createSuhuKelembapanSensor(
				(object) [
					"id_kandang" => $request->id_kandang,
					"date" => $request->date,
					"suhu" => $request->suhu,
					"kelembapan" => $request->kelembapan,
				]);
				return response()->json([
					'message' => 'success created sensor suhu kelembapan',
					'suhuKelembapan' => $suhuKelembapan
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
