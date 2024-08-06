<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{

    public function index(){

        $user = Auth::user();

        $notifications = $user->notifications()->latest()->get();

        $notifications->each(function ($notification) {

            if ($notification->type == 'App\\Notifications\\NewPaymentToConfirm') {

                if ($notification->read_at != null) {
                    $notification->route = 'admin.payment.index';
                    $notification->params = ['status' => 'Pendiente'];
                }

                $notification->type_label = 'Pago por confirmar';
                $notification->description = 'Referencia: ' . $notification->data['reference'] . '<br>' . 'Monto: $ ' . $notification->data['amount_dollar'];

            }

            $date_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date_created_at->isoFormat('D \d\e MMMM, YYYY');
            $notification->formatted_created_at = $formatted_created_at;

        });

        $data = [
            'notifications' => $notifications,
        ];

        return view('notificaciones.index', $data);

    }

    public function delete(DatabaseNotification $notification){

        $notification->delete();

        return redirect()->back();
    }

    /**
     * Get the new notification data for the navbar notification.
     *
     * @param Request $request
     * @return Array
     */
    public function getNotificationsData(Request $request)
    {

        $user = Auth::user();

        return [
            'label' => $user->unreadNotifications()->count(),
            'label_color' => 'danger',
            'icon_color' => 'dark',
        ];
    }

}
