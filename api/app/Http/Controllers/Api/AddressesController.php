<?php

namespace App\Http\Controllers\Api;

// Required Libraries
use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Api\Address\ConsultByPostCodeRequest;
use App\Http\Requests\Api\Address\ConsultByRouteRequest;
use App\Http\Requests\Api\Address\StoreRequest;
use App\Http\Requests\Api\Address\UpdateRequest;

// Resources
use App\Http\Resources\Api\AddressResource;

// Jobs
use App\Jobs\Addresses\CreateAddress;
use App\Jobs\Addresses\DestroyAddress;
use App\Jobs\Addresses\UpdateAddress;

// Models
use App\Models\Address;

// Services
use App\Services\Address\ManageAddress;
use Illuminate\Support\Facades\Bus;

class AddressesController extends Controller
{
    /**
     * @param ConsultByPostCodeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function consultByPostCode(ConsultByPostCodeRequest $request)
    {
        $address = ( new ManageAddress )->consultAddressByPostCode( $request->get('post_code') );
        
        if ( $address )
            return response()->json([ 'status' => 'success', 'address' => ( new AddressResource($address) ) ]);
        
        return response()->json( ['status' => 'error', 'message' => 'Endereço não localizado.'] , 404 );
    }

    /**
     * @param ConsultByRouteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function consultByRoute(ConsultByRouteRequest $request)
    {
        $address = ( new ManageAddress )->consultAddressByRoute( $request->get('route') );
        
        if ( $address )
            return response()->json([ 'status' => 'success', 'addresses' => AddressResource::collection($address) ]);
        
        return response()->json( ['status' => 'error', 'message' => 'Endereço não localizado.'] , 404 );
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $address = Bus::dispatchNow( new CreateAddress($request->all()) );
        
        if ( $address ) 
            return response()->json([ 'status' => 'success', 'address' => ( new AddressResource($address) ) ]);
            
        return response()->json( ['status' => 'error', 'message' => 'Erro ao cadastrar endereço.'] , 500 );    
    }

    /**
     * @param Address $address
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Address $address, UpdateRequest $request )
    {
        $address = Bus::dispatchNow( new UpdateAddress( $address, $request->all() ) );
        
        if ( $address ) 
            return response()->json([ 'status' => 'success', 'address' => ( new AddressResource($address) ) ]);
            
        return response()->json( ['status' => 'error', 'message' => 'Erro ao atualizar endereço.'] , 500 );    
    }

    /**
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show( Address $address )
    {
        return response()->json([ 'status' => 'success', 'address' => ( new AddressResource($address) ) ]);
    }

    /**
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Address $address )
    {
        $result = Bus::dispatchNow( new DestroyAddress( $address ) );
        
        if ( $result ) 
            return response()->json([ 'status' => 'success', 'message' => 'Eendereço excluido com sucesso.' ]);

        return response()->json([ 'status' => 'error', 'message' => 'Erro ao excluir endereço.' ]);
    }

    public function index()
    {
        $addresses = Address::all();
        if ( $addresses )
            return response()->json([ 'status' => 'success', 'addresses' => AddressResource::collection($addresses) ]);

        return response()->json( ['status' => 'error', 'message' => 'Nenhum usuário localizado.'] , 404 );   
    }
}