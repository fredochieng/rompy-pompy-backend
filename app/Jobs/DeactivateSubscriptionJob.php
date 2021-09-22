<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Models\Entities\Models;
use Modules\Subscriptions\Entities\Subscription;

class DeactivateSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sub_status = 1;
        $active_subs = Subscription::GetActiveSubscriptions($sub_status);

        foreach ($active_subs as $key => $value) {
            # code...
            if (Carbon::now()->greaterThan(Carbon::parse($value->sub_end_date))) {
                // Subscription Due
                $sub_stat = array(
                    'sub_status' => 2
                );

                $update_sub = Subscription::where('id', $value->sub_id)->update($sub_stat);

                $model_status = array(
                    'status' => 2
                );

                $update_sub = Models::where('m_model_id', $value->s_model_id)->update($model_status);
            }
        }

    }
}
