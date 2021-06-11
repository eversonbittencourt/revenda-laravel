<?php

namespace App\Http\Controllers\Api;

// Required Libraries
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

// Requests
use App\Http\Requests\Api\Users\LoginRequest;
use App\Http\Requests\Api\Users\StoreRequest;
use App\Http\Requests\Api\Users\UpdateRequest;

// Resources
use App\Http\Resources\Api\UserResource;

// Jobs
use App\Jobs\Users\CreateUser;
use App\Jobs\Users\DestroyUser;
use App\Jobs\Users\UpdateUser;

// Models
use App\Models\User;


class UsersController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('email'))
                    ->first();

        if ( $user ) {
            if (! $token = auth('api')->attempt($request->all())) {
                return response()->json(['status' => 'error', 'message' => 'Erro na autenticacao'], 400);
            } else {
                
                return response()->json([ 'status' => 'success', 'token' => $token ]);
            }
        }
        return response()->json( ['status' => 'error', 'message' => 'Usuário não localizado.'] , 404 );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $users = User::all();
        if ( $users )
            return response()->json([ 'status' => 'success', 'users' => UserResource::collection($users) ]);

        return response()->json( ['status' => 'error', 'message' => 'Nenhum usuário localizado.'] , 404 );
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( StoreRequest $request )
    {
        $user = Bus::dispatchNow( new CreateUser($request->all()) );
        
        if ( $user ) 
            return response()->json([ 'status' => 'success', 'user' => ( new UserResource($user) ) ]);
            
        return response()->json( ['status' => 'error', 'message' => 'Erro ao cadastrar usuário.'] , 500 );    
    }

    /**
     * @param User $user
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( User $user , UpdateRequest $request )
    {
        $user = Bus::dispatchNow( new UpdateUser( $user, $request->all() ) );
        
        if ( $user ) 
            return response()->json([ 'status' => 'success', 'user' => ( new UserResource($user) ) ]);
            
        return response()->json( ['status' => 'error', 'message' => 'Erro ao atualizar usuário.'] , 500 );    
    }
    
    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show( User $user )
    {
        return response()->json([ 'status' => 'success', 'user' => ( new UserResource($user) ) ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( User $user )
    {
        $result = Bus::dispatchNow( new DestroyUser( $user ) );
        
        if ( $result ) 
            return response()->json([ 'status' => 'success', 'message' => 'Usuário excluido com sucesso.' ]);

        return response()->json([ 'status' => 'error', 'message' => 'Erro ao excluir usuário.' ]);
    }
}
