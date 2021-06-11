<?php 
namespace App\Services\Address;

// Models
use App\Models\Address;

class ManageAddress {
    
    /**
     * @param string $post_code
     * @return Address|null
     */
    public function consultAddressByPostCode(string $post_code)
    {
        $address = Address::where('post_code' , $post_code)->first();
        if ( $address )
            return $address;

        $address = ( new ViaCep )->consultAddressByPostCode($post_code);
        if ( $address )
            return $address;

        return null;
    }

    public function consultAddressByRoute( string $route )
    {
        $addresses = Address::where('route', 'like', '%' . $route . '%')->get();
        
        if ( $addresses && count($addresses) > 0 )
            return $addresses;
            
        return null;
    }
}