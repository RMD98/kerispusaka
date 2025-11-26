<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class GDriveExcelService
{
    protected $drive;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->addScope(Drive::DRIVE);
        $client->setAccessType('offline');

        $this->drive = new Drive($client);
    }

    public function findFileByNameInFolder()
    {
        $query = "name = 'dkppp.xlsx' and trashed = false";
        $result = $this->drive->files->listFiles([
            'q' => $query,
            'fields' => 'files(id, name, mimeType, webViewLink)'
        ])->getFiles();

        if(empty($result)){
            return response()->json(['error' =>'File Not Found']);
        }

        $file = $result[0];
        $localPath = storage_path("app/temp/{$file->name}");

        if(!file_exists(dirname($localPath))){
            mkdir(dirname($localPath), 0755, true);
        }

        // $this->downloadExcelFile($file->id,$localPath)s;
        // dd($localPath);

        return array('path'=>$localPath,'file'=>$file);
    }

    public function downloadExcelFile($fileId, $localPath)
    {
        $response = $this->drive->files->get($fileId, ['alt' => 'media']);
        file_put_contents($localPath, $response->getBody()->getContents());
    }

    public function uploadOrUpdateFile($localPath, $fileName)
    {
        $folderId = config('gdrive.folder_id');

        // Check if file exists
        $existingFiles = $this->findFileByNameInFolder($fileName);

        $fileMetadata = new DriveFile([
            'name' => $fileName,
        ]);
        // dd($folderId);
        $content = file_get_contents($localPath);

        if (!empty($existingFiles)) {
            // Update
            $fileId = $existingFiles['file']->getId();
            return $this->drive->files->update($fileId, $fileMetadata, [
                'data' => $content,
                'uploadType' => 'media',
                'fields' => 'id, name',
            ]);
        } else {
            // Upload new
            $fileMetadata->setParents([$folderId]);
            return $this->drive->files->create($fileMetadata, [
                'data' => $content,
                'uploadType' => 'multipart',
                'fields' => 'id, name',
            ]);
        }
    }
}
