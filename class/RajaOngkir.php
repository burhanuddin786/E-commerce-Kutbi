<?php

class RajaOngkir extends Main
{
    public function getProvince()
    {
        return $data = $this->_DB->getAll('province');
    }

    public function getCityDependent($column, $value)
    {
        return $data = $this->_DB->getAllWhere('city', $column, $value);
    }

    public function getCost($destination)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=114&destination=".$destination."&weight=1000&courier=jne",
        CURLOPT_HTTPHEADER => array(
            "key: 98c44f383c939c2ce939028ea8f2e24d",
            "Content-Type: application/x-www-form-urlencoded"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if ($response['rajaongkir']['status']['code'] == '200' && $response['rajaongkir']['status']['description'] == 'OK') {
            $data = $response['rajaongkir']['results'][0]['costs'];
            return $data;
        }

        return 'Error';
    }
}
