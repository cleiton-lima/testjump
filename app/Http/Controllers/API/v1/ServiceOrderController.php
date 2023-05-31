<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceOrderRequest;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehiclePlate = $request->input('vehicle_plate');

        $serviceOrders = ServiceOrder::with('user')
            ->when($vehiclePlate, function ($query) use ($vehiclePlate) {
                return $query->where('vehiclePlate', $vehiclePlate);
            })
            ->paginate(5);

        return response()->json($serviceOrders, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceOrderRequest $request)
    {
        $data = $request->validated();

        $serviceOrder = ServiceOrder::create($data);

        return response()->json($serviceOrder, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $serviceOrder = ServiceOrder::with('user')->find($id);

        if (!$serviceOrder) {
            return response()->json(['message' => 'Ordem de serviço não encontrada.'], 404);
        }

        // Acessando o nome do usuário relacionado
        $userName = $serviceOrder->user->name;

        // Retornando os dados da ordem de serviço e o nome do usuário
        return response()->json([
            'serviceOrder' => $serviceOrder,
            'userName' => $userName
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
