<?php

namespace App\Services;


use Google\Client;

use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        // $credentialsPath = config('services.google_drive.credentials_path');

        // if (!Storage::exists($credentialsPath)) {
        //     throw new \Exception("Google Drive credentials file not found at: {$credentialsPath}");
        // }

        // $this->client = new Client();
        // $this->client->setAuthConfig(config('services.google_drive.credentials_path'));
        // $this->client->addScope(Drive::DRIVE);
        // $this->service = new Drive($this->client);
    }

    public function uploadFile($file, $folderId)
    {
        $fileMetadata = new DriveFile([
            'name' => $file->getClientOriginalName(),
            'parents' => [$folderId],
        ]);

        $content = file_get_contents($file->getRealPath());
        $uploadedFile = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $file->getClientMimeType(),
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink',
        ]);

        return $uploadedFile;
    }
}
