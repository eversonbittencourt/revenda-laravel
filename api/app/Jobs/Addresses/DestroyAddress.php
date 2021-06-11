<?php

namespace App\Jobs\Addresses;

// Models
use App\Models\Address;

// Required Libraries
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class DestroyAddress
{
    use Dispatchable;

    /**
     * @var Address
     */
    private $address;
    
    /**
     * Create a new job instance.
     * 
     * @param Address $address
     * @return void
     */
    public function __construct( Address $address )
    {
        $this->address = $address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->address->delete();
            return $this->address;
        } catch ( QueryException $e ) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
