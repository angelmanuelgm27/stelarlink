<?php

namespace App\Http\Controllers\TechnicalSupport;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    //
    public function index()
    {

        $user = Auth::user();

        $group = $user->group()
            ->leftJoin('zones', 'zone_id', '=', 'zones.id')
            ->select(
                'technical_support_groups.*',
                'zones.name as zone_name',
            )
            ->first();

        $service_requests = Plan::where('status', 'Activo')


            // ->whereRelation('group', 'technical_support_groups.id', $group->id)


            // ->leftJoin('services', 'service_id', '=', 'services.id')
            // ->leftJoin('users', 'user_id', '=', 'users.id')
            // ->leftJoin('zones', 'zone_id', '=', 'zones.id')
            // // ->leftJoin('technical_support_groups', 'group_id', '=', 'technical_support_groups.id')
            // ->select(
            //     'plans.*',
            //     'services.name as service_name',
            //     'users.name as user_name',
            //     'zones.name as zone_name',
            //     // 'technical_support_groups.name as group_name'
            // )

            ->get();

dd($service_requests);

        return view('technical.plan');
    }
}
