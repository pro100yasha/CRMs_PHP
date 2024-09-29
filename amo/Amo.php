<?php
class Amo extends Form{

    private $pipeline_id = 8595098;
    private $user_amo = 0;
    private static $subdomain;
    private static $access_token;
    private static $field_id;

    function __construct($subdomain, $access_token, $field_id){
        Amo::$subdomain = $subdomain;
        Amo::$access_token = $access_token;
        Amo::$field_id = $field_id;
    }
    
    function send(){
        $data = [
            [
                "name" => "Заявка с сайта ".date("d.m.Y / H:i"),
                "responsible_user_id" => (int) $this->user_amo,
                "pipeline_id" => (int) $this->pipeline_id,
                "custom_fields_values" => [
                    [
                        "field_id" => Amo::$field_id,
                        "values" => [
                            [
                                "value" => "Сайт"
                            ]    
                        ]
                    ]
                ],
                "_embedded" => [
                    "tags" => [
                        [
                            "name" => "сайт"
                        ]
                        
                    ],
                    "contacts" => [
                        [
                            "first_name" => parent::$name,
                            "custom_fields_values" => [
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => parent::$phone
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $method = "/api/v4/leads/complex";
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . Amo::$access_token,
        ];

        $out = $this->request($headers, Amo::$subdomain, $method, $data);
        
        $method = "/api/v4/leads/notes";
        
        $data =[
            [
                "entity_id" => $out,
                "note_type" => "common",
                "params"=> [
                    "text" => parent::$comment
                ]
            ]
        ];
        
        $this->request($headers, Amo::$subdomain, $method, $data);
    
    }
    
    function request($headers, $subdomain, $method, $data){

        $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, "https://$subdomain.amocrm.ru".$method);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = json_decode(curl_exec($curl), true)[0]["id"];
            
        return $out;
    }
}

?>