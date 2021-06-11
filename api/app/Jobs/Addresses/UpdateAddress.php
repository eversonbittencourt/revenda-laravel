<?php

namespace App\Jobs\Addresses;

// Models
use App\Models\Address;

// Required Libraries
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UpdateAddress
{
    use Dispatchable;

    /**
     * @var Address
     */
    private $address;
    
    /**
     * @var Collection
     */
    private $data;
    /**
     * Create a new job instance.
     * 
     * @param Address $address
     * @param array $data
     * @return void
     */
    public function __construct( Address $address, array $data )
    {
        $this->address = $address;
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
            $this->address->update( $this->data->toArray() );
            return $this->address;
        } catch ( QueryException $e ) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
