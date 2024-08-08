<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{

    public function instalationFiles($files, $plan)
    {

        foreach ($files as $file) {

            $path = Storage::disk('local')->put('/instalations', $file);

            $file = new File();
            $file->path = $path;
            $file->name = $file->getClientOriginalName();

            $plan->files()->save($file);

        }

    }

}
