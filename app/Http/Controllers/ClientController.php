<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\City;
use App\Models\Client;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Clients/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conditions = Condition::all();
        $cities = City::all();

        return Inertia::render('Clients/Create', [
            'cities' => $cities,
            'conditions' => $conditions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $request->merge([
            'password' => bcrypt('12345678')
        ]);

        Client::create($request->all());

        return Redirect::route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $conditions = Condition::all();
        $cities = City::all();

        return Inertia::render('Clients/Edit', [
            'client' => $client,
            'cities' => $cities,
            'conditions' => $conditions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $input = $request->all();

        $client->update($input);

        return Redirect::route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return Redirect::route('clients.index');
    }

    public function getClients(Request $request)
    {
        $orders = Client::getAllData($request);

        if (empty($request->reqType)) {
            return ['datarows' => $orders['data'], 'count' => $orders['count']];
        } else {
            return ['datarows' => $orders];
        }
    }
}
