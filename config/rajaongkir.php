<?php

return [
	/*
    |--------------------------------------------------------------------------
    | End Point Api ( Konfigurasi Server Akun )
    |--------------------------------------------------------------------------
    | Starter : http://rajaongkir.com/api/starter
    | Basic : http://rajaongkir.com/api/basic
    | Pro : http://pro.rajaongkir.com/api
    |
    */
	//'end_point_api' => env('RAJAONGKIR_ENDPOINTAPI', 'http://rajaongkir.com/api/starter'),
    'end_point_api' => env('RAJAONGKIR_ENDPOINTAPI'),
	/*
    |--------------------------------------------------------------------------
    | Api key
    |--------------------------------------------------------------------------
    | Isi dengan api key yang didapatkan dari rajaongkir
    |
    */
	//'api_key' => env('RAJAONGKIR_APIKEY', 'SomeRandomString'),
    'api_key' => env('RAJAONGKIR_APIKEY'),
    
    /*
    atau anda juga dapat langsung melakukan konfigurasi di file rajaongkir.php di folder config seperti kode berikut.
    /---------------------------------------------------------
    'end_point_api' => 'isi_base_url_api_akun_anda_disini',
    'api_key' => 'isi_api_key_anda_disini',
    */

];