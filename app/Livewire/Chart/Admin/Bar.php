<?php

namespace App\Livewire\Chart\Admin;

use Livewire\Component;
use App\Models\Children;
use App\Models\Parents;
use App\Models\Staff;

class Bar extends Component
{

    public $data;

    public function mount()
    {
        $this->data = $this->barChart();
    }
    public function barChart()
    {
        // Query the database for counts
        $childrenCount = Children::count();
        $parentsCount = Parents::count();
        $staffCount = Staff::count();

        // Prepare the data for the chart
        $data = [
            'labels' => ['Children', 'Parents', 'Staff'],
            'data' => [$childrenCount, $parentsCount, $staffCount],
        ];

        return $data;
    }
    public function render()
    {
        return view('livewire.chart.admin.bar');
    }
}
