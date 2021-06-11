<?php

namespace App\Jobs\Users;

// Models
use App\Models\User;

// Required Libraries
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class DestroyUser
{
    use Dispatchable;

    /**
     * @var User
     */
    private $user;
    
    /**
     * Create a new job instance.
     * 
     * @param User $user
     * @return void
     */
    public function __construct( User $user )
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->user->delete();
            return $this->user;
        } catch ( QueryException $e ) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
