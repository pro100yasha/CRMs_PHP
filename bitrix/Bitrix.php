<?php 
class Bitrix extends Form{
    //private $method = "crm.deal.add"; /*"https://b24-l7tyhg.bitrix24.ru/rest/1/qjl5mtkf1pt66473/crm.deal.add";*/

    function __construct(){}

    function send(){

        $data = [
            "fields"=>[
                "NAME" => parent::$name,
                "TYPE_ID" => "CLIENT",
                "PHONE" => [
                    [
                        "VALUE" => parent::$phone,
                        "VALUE_TYPE" => "WORK"
                    ]  
                ],
            ],
            "params" => ["REGISTER_SONET_EVENT" => "Y"]
        ];

        $out = $this->request($data, "crm.contact.add");
        
        $data = [
            "fields"=>[
                "TITLE" => "Заявка с сайта ".date("d.m.Y / H:i"),
                "COMMENTS" => parent::$comment,
                "CONTACT_ID" => $out["result"]
            ],
            "params" => ["REGISTER_SONET_EVENT" => "Y"]
        ];

        $out = $this->request($data, "crm.deal.add");
        
        // print_r($out);

        /* 
        { 
			"NAME": "Глеб", 
			"SECOND_NAME": "Егорович", 
			"LAST_NAME": "Титов", 
			"OPENED": "Y", 
			"ASSIGNED_BY_ID": 1, 
			"TYPE_ID": "CLIENT",
			"SOURCE_ID": "SELF",
			"PHOTO": { "fileData": document.getElementById('photo') },
			"PHONE": [ { "VALUE": "555888", "VALUE_TYPE": "WORK" } ] 	
		},
        */
        
    }
    
    function request($data, $method){

            $headers = [
                'Content-Type: application/json'
            ];
    
            $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, "https://b24-l7tyhg.bitrix24.ru/rest/1/qjl5mtkf1pt66473/".$method);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $out = json_decode(curl_exec($curl), true);

            return $out;
        }    
    
}


?>