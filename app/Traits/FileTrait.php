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

            $instalation_file = new File();
            $instalation_file->path = $path;
            $instalation_file->name = $file->getClientOriginalName();

            $plan->files()->save($instalation_file);

        }

    }

}
