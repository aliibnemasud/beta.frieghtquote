<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'vendor/autoload.php';
require_once APPPATH . 'vendor/google/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Quote_mcc extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('General_m');
        $this->load->helper(array('form', 'url'));

        $this->client = new Google_Client();
        $this->clientId = '908107837597-7731l9bhm01h0m1dl5ag7jfp4kqvpa3l.apps.googleusercontent.com';
        $this->clientSecret = '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';
    }

    public function index()
    {
        $user = wp_get_current_user();
        $user = json_decode(json_encode($user), TRUE);
        $data['username'] = $user['data']['display_name'];
        $id = $_GET['id'];
        $id = base64_decode($id);
        $data['carrier'] = $this->General_m->get_carrier();
        $data['data'] = $this->General_m->get_quote($id);
        if ($data['data'][0]['mcc_user'] == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
            $data['mcc_name'] = $this->General_m->get_mcc_name($data['data'][0]['mcc_user']);
        }
        $freight_id = $data['data'][0]['id']; // Assuming 'freight_id' is the correct field name
        $pallets = $this->General_m->get_pallets_by_freight_id($freight_id);
        $data['pallets'] = $pallets;
        $this->load->view('mcc_view', $data);
        }


    protected function getCountry($abbr)
    {
        if ($abbr == 'US') {
            return 'USA';
        }
        if ($abbr == 'CA') {
            return 'Canada';
        }
        return $abbr;
    }

    public function save_carrier()
    {
        $data['carrier_name'] = $this->input->post("carrier_name");
        $data['carrier_phone'] = $this->input->post("carrier_phone");
        $data['carrier_city'] = $this->input->post("carrier_city");
        $data['carrier_state'] = $this->input->post("carrier_state");
        $data['carrier_country'] = $this->getCountry($this->input->post("carrier_country"));
        $data['carrier_zip_code'] = $this->input->post("carrier_zip_code");
        $data['contact_first'] = $this->input->post("contact_first");
        $data['contact_second'] = $this->input->post("contact_second");
        $data['contact_email'] = $this->input->post("contact_email");
        $data['contact_phone'] = $this->input->post("contact_phone");
        $result = $this->General_m->save_carrier($data);
        echo (json_encode($result));
    }
    
    
    // Saving the Pallets
    public function save_pallets_test() {
        $palletData = $this->input->post("pallet_data");
        $formattedPalletData = stripslashes($palletData);
        $decodedPalletData = json_decode($formattedPalletData, true);
        if (!empty($decodedPalletData)) {
        $result = $this->General_m->save_pallets_test($decodedPalletData);
        echo json_encode(['status' => 'success', 'message' => 'Pallet data saved successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No pallet data provided']);
        }
    }
    
    public function update_mcc()
    {
        // Token generation logic
        // $token_url = '';
        // $client_id = '';
        // $client_secret = '';
        // $resource_url = 'https://intercotradingco.crm.dynamics.com';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $token_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'grant_type' => 'client_credentials',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'resource' => $resource_url,
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $token_data = json_decode($response, true);

        if (isset($token_data['access_token'])) {
            $access_token = $token_data['access_token'];
        } else {
            echo json_encode(['error' => 'Failed to acquire access token']);
            return;
        }        
        
        //  Previous Code

        $carrier = $this->input->post("carrier");
        $rate = $this->input->post("rate");
        $mcc_date = date("Y-m-d H:i:s");
        $note = $this->input->post("note");
        $id = $this->input->post("hidden_id");
        $user = wp_get_current_user();
        $user = json_decode(json_encode($user), TRUE);
        $mcc_user = $user['data']['ID'];
        $data = $this->General_m->update_mcc($id, $carrier, $rate, $mcc_date, $mcc_user, $note);
        $data[0]['mcc_email'] = $user['data']['user_email'];


        $diff = abs(strtotime($data[0]['mcc_date']) - strtotime($data[0]['trader_date']));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
        $days = str_pad($days, 2, "0", STR_PAD_LEFT);
        $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        $diff_date = $days . ":" . $hours . ":" . $minutes;

        $cell['trader_date'] = [
            'userEnteredValue' => [
                'stringValue' => date("m/d/y H:i A", strtotime($data[0]['trader_date']))
            ],
        ];

        $cell['trader'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['trader']
            ],
        ];

        $cell['trader_email'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['trader_email']
            ],
        ];

        $cell['origin_company'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['origin_company']
            ],
        ];

        $cell['origin_city'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['origin_city']
            ],
        ];

        $cell['origin_state'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['origin_state'],
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];

        $cell['origin_zip_code'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['origin_zip_code'],
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];

        $cell['dest_company'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['dest_company']
            ],
        ];

        $cell['dest_city'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['dest_city']
            ],
        ];

        $cell['dest_state'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['dest_state'],
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];

        $cell['dest_zip_code'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['dest_zip_code'],
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];

        $cell['van_dump'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['van_dump'],
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];

        $cell['commodity'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['commodity']
            ]
        ];
        $cell['weight'] = [
            'userEnteredValue' => [
                'stringValue' => number_format($data[0]['weight']),
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];
        $cell['carrier_name'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['carrier_name']
            ]
        ];
        $cell['rate'] = [
            'userEnteredValue' => [
                'stringValue' => "$" . number_format($data[0]['rate']),
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];
        $cell['mcc_user'] = [
            'userEnteredValue' => [
                'stringValue' => $data[0]['mcc_user'],
            ]
        ];
        $cell['mcc_date'] = [
            'userEnteredValue' => [
                'stringValue' => date("m/d/y H:i A", strtotime($data[0]['mcc_date']))
            ]
        ];
        
        $cell['interco_facility'] = [
        'userEnteredValue' => [
            'stringValue' => $data[0]['interco_facility']
            ]
        ];

        $cell['diff'] = [
            'userEnteredValue' => [
                'stringValue' => $diff_date,
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];        
        
        $to = $data[0]['trader_email'];
        // $to = $data[0]['trader_email'] . ', freightrate@intercotradingco.com';
        // $to = $data[0]['trader_email'] . ', connors@intercotradingco.com';        
        $subject = 'Freight Quote - ' . $data[0]['origin_city'] . ", " . $data[0]['origin_state'] . " " . $data[0]['origin_zip_code'] . " " . $data[0]['origin_country'];
        $message = $this->load->view("Email_trader_back", $data[0], TRUE);        
        $headers = "From: " . strip_tags($data[0]['mcc_user']) . "\r\n";
        $headers .= "Reply-To: " . strip_tags($data[0]['mcc_email']) . "\r\n";        
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to, $subject, $message, $headers);       

        $response_data = [
            'status' => 'success',
            'message' => 'Freight Quote has been sent to the ITC Trader',
            'access_token' => $access_token,
        ];
        // echo (json_encode("success"));
        echo json_encode($response_data);
    }

    public function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('freightquote');
        $client->setAuthConfig('assets/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $client->addScope(Google_Service_Sheets::SPREADSHEETS);

        $tokenPath = 'assets/token.json';
        // if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
        // }

        return $client;
    }
}
ini_set('display_errors', 0);
