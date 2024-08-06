<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationSeenController extends Controller
{

    public function __invoke(DatabaseNotification $notification)
    {

        $notification->markAsRead();

        if ($notification->type == 'App\\Notifications\\NewPaymentToConfirm') {
             return redirect()->route('admin.payment.index', ['status' => 'Pendiente']);
        }

        return redirect()->back();

    }

}
