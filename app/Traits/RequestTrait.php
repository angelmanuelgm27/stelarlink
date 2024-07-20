<?php

namespace App\Traits;

use App\Models\Solicitudes;
use App\Models\Task;
use App\Models\TechnicalSupportGroup;

trait RequestTrait
{

    public function asign(Solicitudes $solicitudes)
    {

        $group = TechnicalSupportGroup::where('availability', 'Disponible')
        ->inRandomOrder()
        ->first();

        if($group){

            $task = new Task();

            $task->technical_support_group_id = $group->id;

            $solicitudes->task()->save($task);

            $solicitudes->update(['status' => 'Asignada']);

            $group->update(['availability' => 'No disponible']);

        }

    }

}
