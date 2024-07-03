<?php

namespace App\Livewire\Chart\Admin;

use Livewire\Component;
use App\Models\Attendance;

class Line extends Component
{
    public $data;

    public function mount()
    {
        $this->data = $this->lineChart();
    }

    public function lineChart()
    {
        // Query the database for attendance counts by date
        $attendanceCounts = Attendance::selectRaw('date(created_at) as date, count(*) as count')
                                      ->groupBy('date')
                                      ->orderBy('date')
                                      ->get()
                                      ->map(function ($attendance) {
                                          return [
                                              'label' => $attendance->date,
                                              'value' => $attendance->count,
                                          ];
                                      });

        // Prepare the data for the chart
        $data = [
            'labels' => $attendanceCounts->pluck('label')->toArray(),
            'data' => $attendanceCounts->pluck('value')->toArray(),
        ];

        return $data;
    }

    public function render()
    {
        return view('livewire.chart.admin.line');
    }
}