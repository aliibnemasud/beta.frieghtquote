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
        $this->load->view('mcc_view', $data);
    }

    protected function getCountry($abbr)
    {
        if ($abbr == 'US') {
            return 'USA';
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

    public function update_mcc()
    {
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

        $cell['diff'] = [
            'userEnteredValue' => [
                'stringValue' => $diff_date,
            ],
            'userEnteredFormat' => [
                "horizontalAlignment" => "center",
            ]
        ];

        /*
        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);
        $spreadsheetId = 'LrwZ47MA5ecBlRnMSzyNbLRqFqdXZGZ9ZE51D_AwhM';
        $fileId = $spreadsheetId;

        $cells = [$cell['trader_date'], $cell['trader'], $cell['trader_email'], $cell['origin_company'], $cell['origin_city'], $cell['origin_state'], $cell['origin_zip_code'], $cell['dest_company'], $cell['dest_city'], $cell['dest_state'], $cell['dest_zip_code'], $cell['van_dump'], $cell['commodity'], $cell['weight'], $cell['carrier_name'], $cell['rate'], $cell['mcc_user'], $cell['mcc_date'], $cell['diff']];
        $row = [
            'values' => $cells
        ];
        $rows[] = $row;

        $appendCellsRequest = [
            'fields' => '*',
            'rows' => $rows
        ];

        $request = [
            'appendCells' => $appendCellsRequest
        ];

        $batchUpdate = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => [$request]
        ]);

        $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdate);


        // $data[0]['share_link'] = "https://drive.google.com/file/d/".$share_id."/view";
        $data[0]['share_link'] = "";
        $update = $this->General_m->update_sharing_link($data[0]['id'], $data[0]['share_link']);
*/
        $to = $data[0]['trader_email'];
        // $to = "jinmeng@jin-site.com";
        $subject = 'MCC Freight Quote -- ' . $data[0]['origin_company'] . " - " . $data[0]['origin_city'] . " " . $data[0]['origin_zip_code'];
        $message = $this->load->view("Email_trader_back", $data[0], TRUE);
        $headers = "From: " . strip_tags($data[0]['mcc_email']) . "\r\n";
        $headers .= "Reply-To: " . strip_tags($data[0]['mcc_email']) . "\r\n";
        // $headers .= "CC: jinmeng@jin-site.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to, $subject, $message, $headers);

        echo (json_encode("success"));

        // redirect("https://itcep.intercotradingco.com/");
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
