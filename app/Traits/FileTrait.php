<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{

    public function instalationFiles($files, $request)
    {

        foreach ($files as $file_request) {

            $path = Storage::disk('local')->put('/instalations', $file_request);

            $file = new File();
            $file->path = $path;
            $file->name = $file_request->getClientOriginalName();

            $request->files()->save($file);

        }

    }

}
