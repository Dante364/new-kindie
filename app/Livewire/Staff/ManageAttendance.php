<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Children;
use Mary\Traits\Toast;

class ManageAttendance extends Component
{
    use Toast;

    public $child_id, $date, $status, $id;

    public function absent($id)
    {
        $child = Children::find($id);

        Attendance::create([
            'child_id' => $child->id,
            'date' => now(),
            'status' => 'absent',
        ]);

        $this->success('Child marked absent');
    }

    public function present($id)
    {
        $child = Children::find($id);

        Attendance::create([
            'child_id' => $child->id,
            'date' => now(),
            'status' => 'present',
        ]);

        $this->success('Child marked present');
    }
    public function render()
    {
        return view('livewire.staff.manage-attendance');
    }
}
