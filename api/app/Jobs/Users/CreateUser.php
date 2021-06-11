<?php

namespace App\Jobs\Users;

// Models
use App\Models\User;

// Required Libraries
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class CreateUser
{
    use Dispatchable;
    
    /**
     * @var Collection
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( array $data )
    {
        $this->data = collect($data);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $user = User::create( $this->data->toArray() );
            return $user;
        } catch ( QueryException $e ) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
