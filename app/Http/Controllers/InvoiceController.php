<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{

    public function show(Invoice $invoice){

        // ***

        $file = $invoice->file;

        $file_path = storage_path('app') . $file->name;
        if (file_exists($file->path)) {
            return Storage::disk('local')->download($file->name);
        }

    }

}
