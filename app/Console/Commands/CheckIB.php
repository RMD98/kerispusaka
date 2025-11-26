<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Http\Request;
use Google\Service\Drive\DriveFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DB;
use GuzzleHttp\Client as WA;
use Date;

class CheckIB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-i-b';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    private function getClient()
        {
            $client = new Client();
            $client->setAuthConfig(storage_path('credentials.json'));
            $client->addScope(Drive::DRIVE);
            $client->setAccessType('offline');
    
            return $client;
        }
    
        public function listFiles()
        {
            $client = $this->getClient();
            $service = new Drive($client);
            $files = $service->files->listFiles();
            $query = "name = 'Date.xlsx' and trashed = false";
            $results = $service->files->listFiles([
                'q' => $query,
                'fields' => 'files(id, name, mimeType, webViewLink)'
            ]);
            // \Log::info($results->getFiles()[0]->id);
            // \Log::info($results->getFiles());
            // return response()->json($files);
            $this->getScheduleFromExcel($results->getFiles()[0]->id);
        }
        public function downloadExcelFile($fileId)
        {
            $client = new Client();
            $client->setAuthConfig(storage_path('credentials.json'));
            $client->addScope(Drive::DRIVE);
            $service = new Drive($client);
    
            // Get file metadata
            $file = $service->files->get($fileId, ['fields' => 'name,mimeType']);
            
            // Download file content
            $response = $service->files->get($fileId, ['alt' => 'media']);
            $content = $response->getBody()->getContents();
    
            // Save locally
            $filePath = storage_path('app/' . $file->name);
            file_put_contents($filePath, $content);
            $this->getScheduleFromExcel($fileId);
            // return response()->json(['filePath' => $filePath]);
        }        
    public function getScheduleFromExcel($fileId)
    {
        $client = new Client();
        $wa = new WA(
            // [
            // // Base URI is used with relative requests
            // 'base_uri' => 'https://hooks.zapier.com/hooks/catch/21670539/2a7utt5/',
            // // You can set any number of default request options.
            // 'timeout'  => 2.0,
            // ]
        );
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->addScope(Drive::DRIVE);
        $service = new Drive($client);

        $file = $service->files->get($fileId, ['fields' => 'name,mimeType']);
        $response = $service->files->get($fileId, ['alt' => 'media']);
        $content = $response->getBody()->getContents();

        $filePath = storage_path('app/' . $file->name);
        file_put_contents($filePath, $content);

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = [];

        foreach ($sheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            $rows[] = $rowData;
        }
        $tanggalIndex = array_search('tanggal',$rows[0]);
        $tanggal =[];
        
        foreach ($rows as $key=>$val){
            if ($key > 0){

                // $cellValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($val[$tanggalIndex]->getPlainText())->format('Y-m-d');
                $date = new \Datetime(\DateTime::createFromFormat('m/d/Y', $val[$tanggalIndex]->getPlainText())->format('Y-m-d')) ;
                // print_r($date->diff(new \DateTime)->days);
                $diff = $date->diff(new \DateTime)->days ;
                if ( $diff <= 30){
                    $tanggal[]= $val;
                 
                    $url ='https://graph.facebook.com/v21.0/544200302114640/messages';
                    $token = 'EAASbD1Xo8JUBO7Ug75VFVOU1T3o08ajEA0NJhFnIczd5hY63LFJsjx69Id85lqfb22LBboZA33NXL6i8sW1Jn1O0ummvGbGN8LLoZC6z7OVTPQneUUZB5RBkVWaDHBCWETZA1ACuIoHU08YwvG1BZCxF3UUONfUMIOTdvl4uIcBjqphmvWsafK3AbvIr9mWQcDBDfxgOxeb6juqnVcvpYLyLD6N8ZD';
                    $data = [
                        "messaging_product" => "whatsapp",
                        "to" => "6283163374681",
                        "type" => "template",
                        "template" => [
                            "name" => "reminder",
                            "language" => ["code" => "id"],
                            "components" => [
                                [
                                    "type" => "body",
                                    "parameters" => [
                                        
                                            ["type"=> "text", "text" => $val[0]],
                                            ["type"=> "text", "text" => $val[$tanggalIndex]->getPlainText()],
                                            ["type"=> "text", "text" => $diff],

                                        
                                    ]
                                ]
                            ]
                        ]
                    ];
            
                    $r = $wa->request('POST', $url, [
                        'headers' => [
                            'Authorization' => 'Bearer '.$token,
                            'Content-Type' => 'application/json'
                        ],
                        'json'=> $data,
                        ]);
                }
            }
        }
        // var_dump($tanggal);
        // print_r($tanggal);
        $rows = $tanggal;
        \Log::info($rows);
        
        // return view('excel_view', compact('rows'));
    }
    public function handle()
    {
        $this->listFiles();
        
    }
}
