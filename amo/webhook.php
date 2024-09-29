<?php
require_once 'access.php';

$post = $_POST["leads"]["add"][0];
$id = $post["id"];
$created_user_id = $post["created_user_id"];
$method = "/api/v4/leads";

    $f = fopen("new_file.txt", 'w');
    fwrite($f, $subdomain.$method.$access_token);
    fclose($f);

if ($created_user_id != "0") {
    
    $data = [
        [
            "id" => (int)$id,
            "custom_fields_values" => [
                [
                    "field_id" => $field_id,
                    "values" => [
                        [
                            "value" => "Создана вручную"
                        ]    
                    ]
                ]
            ]
        ]
    ];
    
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' .$access_token,
    ];
    
    $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, "https://$subdomain.amocrm.ru".$method);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $out = json_decode(curl_exec($curl), true)[0]["id"];
    

}

?>