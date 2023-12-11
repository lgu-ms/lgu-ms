<?php

function verifyResponse($captcha_secret_key, $token)
{
    $client = new GuzzleHttp\Client();
    $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret' => $captcha_secret_key,
            'response' => $token
        ]
    ]);
    $result = json_decode($response->getBody());
    return $result->success;
}
?>