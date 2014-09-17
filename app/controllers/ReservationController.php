<?php

class ReservationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /reservation
	 *
	 * @return Response
	 */
	public function index() {
		$Boats = Boat::where('public', '=', '1')->orderBy('order', 'ASC')->get();
		$Tours = Tour::where('public', '=', '1')->orderBy('order', 'ASC')->get();
		return View::make('frontPage/vistaFormulario')->with('boats', $Boats)->with('tours', $Tours);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /reservation/create
	 *
	 * @return Response
	 */
	public function create() {
		// $input = Input::get('name', 'lastName');
		// var_dump($input);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /reservation
	 *
	 * @return Response
	 */
	public function store() {
		$input       = Input::all();
		$client      = Input::only('rifInicio', 'identification', 'name', 'lastName', 'email', 'phone');
		$reservation = Input::only('fecha', 'pasajesadultos', '3eraEdad', 'ninos', 'hora', 'Boat');
		var_dump($reservation);
		//verificar si cliente existe
		$searchClient = Client::where('identification', '=', $client['rifInicio'].'-'.$client['identification'])->orwhere('email', '=', $client['email'])->orwhere('phone', '=', $client['phone'])->get();
		if ($searchClient->count() > 0):
		//si existe lo utilizo
		$cliente = $searchClient->first();
		 else :
		// sino lo creo
		$cliente = new Client;
		endif;
		// actualizar o crear datos de cliente
		$cliente->name           = $client['name'];
		$cliente->lastname       = $client['lastName'];
		$cliente->identification = $client['rifInicio'].'-'.$client['identification'];
		$cliente->email          = $client['email'];
		$cliente->phone          = $client['phone'];
		$cliente->save();
		// verificar si est duplicada la reserva
		$boat                = Boat::where('name', '=', $reservation['Boat'])->first();
		$tour                = Tour::where('id', '=', $reservation['hora'])->first();
		$precio              = $tour->prices()->orderBy('id', 'DESC')->first();
		$montoTotal          = ($reservation['pasajesadultos']*$precio->adult)+($reservation['3eraEdad']*$precio->older)+($reservation['ninos']*$precio->child);
		$busquedaReservacion = Reservation::where('client_id', '=', $cliente->id)->where('boat_id', '=', $boat->id)->where('tour_id', '='.$tour->id)->get();
		if ($busquedaReservacion->count() > 0):
		echo 'ya existe una reseva asi';
		 else :
		$reservacion               = new Reservation;
		$reservacion->date         = $reservation['fecha'];
		$reservacion->references   = 'Nueva Reservacion';
		$reservacion->adults       = $reservation['pasajesadultos'];
		$reservacion->olders       = $reservation['3eraEdad'];
		$reservacion->childs       = $reservation['ninos'];
		$reservacion->totalAmmount = $montoTotal;
		$reservacion->client_id    = $cliente->id;
		$reservacion->boat_id      = $boat->id;
		$reservacion->tour_id      = $tour->id;
		$reservacion->save();
		echo 'Reserva realizada<br/>';
		var_dump($reservacion);
		endif;

		// var_dump($boat->name);
		// $reserva= Reserva::where()

	}

	/**
	 * Display the specified resource.
	 * GET /reservation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /reservation/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /reservation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /reservation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}