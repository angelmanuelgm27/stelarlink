<?php

namespace App\Traits;

use App\Models\Plan;
use App\Models\Task;
use App\Models\TechnicalSupportGroup;

trait RequestTrait
{

    public function asign(Plan $plan)
    {

        $group = TechnicalSupportGroup::where('availability', 'Disponible')
            ->where('zone_id', $plan->zone_id)
            ->orderBy('last_instalation', 'asc')
            ->first();

        if($group){

            $task = new Task();

            $task->technical_support_group_id = $group->id;

            $plan->task()->save($task);

            $plan->update([
                'status' => 'Asignado',
                'technical_support_group_id' => $group->id,
            ]);

            $group->update(['availability' => 'No disponible']);

        }

    }

}
