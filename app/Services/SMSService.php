<?php
/**
 * Created by PhpStorm.
 * User: DevKobby
 * Date: 3/9/2020
 * Time: 11:21 PM
 */

namespace App\Services;


class SMSService
{
    protected $contact , $message = '';
    protected $accountId = 'oDffeQeAHpuvepzii0OjcA==';
    protected $token = 'SKA+ftDcurKzcXyalhgLMY5e62ZquWKRZGzfXo9XX0A=';

    function __construct($contact , $message)
    {
        $this->contact = $contact;
        $this->message = $message;
    }
    /*protected $accountId = config('sms.KIRUSA_ACC_ID', 'oDffeQeAHpuvepzii0OjcA==');

    protected $accountToken = config('sms.KIRUSA_API_TOKEN', 'SKA+ftDcurKzcXyalhgLMY5e62ZquWKRZGzfXo9XX0A=');

    function __construct()
    {

    }*/

    public function sendMessage(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://konnect.kirusa.com/api/v1/Accounts/{$this->accountId}/Messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\"id\":\"Udel\",\r\"to\":[\"$this->contact\"],\r\"sender_mask\":\"Udel\",\r\"body\":\"$this->message\"\r}\r",
            CURLOPT_HTTPHEADER => array(
                "Authorization: {$this->token}",
                "Content-Type: application/json"
            )
        ));

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json([
                'error' => "cURL Error #:" . $err,
            ], 400);
        } else {
            return $response;
        }
    }
}
