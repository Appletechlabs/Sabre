<?php

namespace Appletechlabs\Sabre;

use GuzzleHttp\Client;
use stdClass;
class Sabre
{

    private $Version = "V1";

    private $UserID;

    private $Group;

    private $Domain;

    private $ClientSecret;

    private $Key;

    private $Header;

    private $BaseUrl = "https://api-crt.cert.havail.sabre.com";


    function __construct($UserID, $Group, $ClientSecret, $Domain = 'AA', $BaseUrl = "https://api-crt.cert.havail.sabre.com")
    {

        $this->UserID = $UserID;
        $this->Group = $Group;
        $this->ClientSecret = $ClientSecret;
        $this->Domain = $Domain;
        $this->BaseUrl = $BaseUrl;

        $this->Key = base64_encode(base64_encode("{$this->Version}:{$this->UserID}:{$this->Group}:{$this->Domain}") . ":" . base64_encode($this->ClientSecret));

        $this->Header = [
            "Authorization" => "Basic " . $this->Key,
            "Content-Type" => 'application/x-www-form-urlencoded',
            "grant_type" => 'client_credentials'
        ];
    }


    function getToken():stdClass
    {

        $client = new Client(['base_uri' => $this->BaseUrl]);

        $response = $client->request("POST", '/v2/auth/token', [
            'form_params' => $this->Header
        ]);

        return json_decode($response->getBody());

    }

}