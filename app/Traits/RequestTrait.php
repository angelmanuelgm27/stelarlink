<?php

namespace App\Traits;

use App\Models\Solicitudes;
use App\Models\Task;
use App\Models\TechnicalSupportGroup;

trait RequestTrait
{

    public function asign(Solicitudes $solicitud)
    {

        $group = TechnicalSupportGroup::where('availability', 'Disponible')
            ->where('zone_id', $solicitud->zone_id)
            ->orderBy('last_instalation', 'asc')
            ->first();

        if($group){

            $task = new Task();

            $task->technical_support_group_id = $group->id;

            $solicitud->task()->save($task);

            $solicitud->update(['status' => 'Asignada']);

            $group->update(['availability' => 'No disponible']);

        }

    }

}
