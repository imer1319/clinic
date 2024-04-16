<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function runBackup()
    {
        Artisan::call('backup:run --only-db');
        $path = storage_path('app/Laravel/*');
        $latest_ctime = 0;
        $latest_filename = '';
        $files = glob($path);
        foreach($files as $file)
        {
            if (is_file($file) && filectime($file) > $latest_ctime)
            {
                $latest_ctime = filectime($file);
                $latest_filename = $file;
            }
        }
        $response = response()->download($latest_filename);

        return $response;
    }
}
