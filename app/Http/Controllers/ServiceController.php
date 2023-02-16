<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all(); 
        return response()->json($services);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $service = new Service;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $data = [
            'message' => 'Service created successfully',
            'client' => $service,
        ];
        return response()->json($data);
    }
    public function show(Service $service)
    {
        return response()->json($service);
    }
    public function edit(Service $service)
    {
        //
    }
    public function update(Request $request, Service $service)
    {
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $data = [
            'message' => 'Service updated successfully',
            'client' => $service,
        ];
        return response()->json($data);
    }
    public function destroy(Service $service)
    {
        $service->delete();
        $data = [
            'message' => 'Service deleted successfully',
            'client' => $service,
        ];
        return response()->json($data);
    }

    // metodo para mostrar todos los clientes asociados a un servicio
    public function clients(Request $request){
        $service = Service::find($request->service_id);
        $clients = $service->clients;
        $data = [
            'message' => 'Service fetched successfully',
            'client' => $clients,
        ];
        return response()->json($data);
    }
}
