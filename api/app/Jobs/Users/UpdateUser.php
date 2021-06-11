<?php

namespace App\Jobs\Users;

// Models
use App\Models\User;

// Required Libraries
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UpdateUser
{
    use Dispatchable;

    /**
     * @var User
     */
    private $user;
    
    /**
     * @var Collection
     */
    private $data;
    /**
     * Create a new job instance.
     * 
     * @param User $user
     * @param array $data
     * @return void
     */
    public function __construct( User $user, array $data )
    {
        $this->user = $user;
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
            $this->user->update( $this->data->toArray() );
            return $this->user;
        } catch ( QueryException $e ) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
