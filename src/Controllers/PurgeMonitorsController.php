<?php

namespace violetshih\MongoQueueMonitor\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use violetshih\MongoQueueMonitor\Models\Contracts\MonitorContract;
use violetshih\MongoQueueMonitor\Services\QueueMonitor;

class PurgeMonitorsController
{
    public function __invoke(Request $request, String $viewname = null)
    {
        $model = QueueMonitor::getModel();

        $model->newQuery()->each(function (MonitorContract $monitor) {
            $monitor->delete();
        }, 200);

				if (($viewname) && (View::exists($viewname))) {
					$viewname = $viewname;
				}
				else {
					$viewname = null;
				}

        return redirect()->route('queue-monitor::index', ['viewname' => $viewname]);
    }
}
