<?php 
namespace App\Services\Address;

// Models
use App\Models\Address;

// Required Libraries
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Bus;

class ViaCep {
    
    /**
     * @param string $post_code
     * @return Address|null
     */
    public function consultAddressByPostCode(string $post_code)
    {
        $url = 'https://viacep.com.br/ws/' . $post_code . '/json';
        $request = Http::get($url);
        if ( $request->status() == 200 ) {
            $data = $request->json();
            $params = [
                'post_code'     => $post_code,
                'route'         => $data['logradouro'],
                'neighborhood'  => $data['bairro'],
                'city'          => $data['localidade'],
                'state'         => $data['uf']
            ];
            $address = Bus::dispatchNow( Address::create( $params ) );
            if ( $address )
                return $address;
        }
        return null;
    }
}