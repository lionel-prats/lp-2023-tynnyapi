<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $array = [];
        foreach($clients as $client){
            $array[] = [
                'id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'password' => $client->password,
                'phone' => $client->phone,
                'address' => $client->address,
                'services' => $client->services
            ];   
        }
        return response()->json($array);
    }
    public function create()
    {
        // se utiliza para mostrar formularios que crean registros
    }
    public function store(Request $request)
    {
        $client = new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = $request->password;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
        $data = [
            'message' => 'Client created successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }
    public function show(Client $client)
    {
        $data = [
            'message' => 'Client details',
            'client' => $client,
            'services' => $client->services
        ];
        return response()->json($data);
    }
    public function edit(Client $client)
    {
        // se utiliza para mostrar formularios que editan registros
    }
    public function update(Request $request, Client $client)
    {
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
        $data = [
            'message' => 'Client updated successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }
    public function destroy(Client $client)
    {
        $client->delete();
        $data = [
            'message' => 'Client deleted successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }

    // agrega un registro en la tabla pivote clients_services
    public function attach(Request $request){
        $client = Client::find($request->client_id);
        $client->services()->attach($request->service_id);
        $data = [
            'message' => 'Service attached successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }
    
    // elimina un registro en la tabla pivote clients_services
    public function detach(Request $request){
        $client = Client::find($request->client_id);
        $client->services()->detach($request->service_id);
        $data = [
            'message' => 'Service detached successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }
}
