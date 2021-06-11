<?php

namespace App\Jobs\Addresses;

// Models
use App\Models\Address;

// Required Libraries
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class CreateAddress
{
    use Dispatchable;

    /**
     * @var Collection
     */
    private $data;

    /**
     * Create a new job instance.
     * @param array $data;
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
            
            $address = Address::create( $this->data->toArray() );
            if ( $address )
                return $address; 

            return null;

        } catch ( QueryException $e ) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
