<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Staff;
use Mary\Traits\Toast;

class ViewStaff extends Component
{
    use Toast;

    public $name, $email, $password, $id, $phone;

    public bool $addModal = false;
    public bool $editModal = false;

    public function openCreateModal()
    {
        $this->reset();
        $this->addModal = true;
    }

    public function closeCreateModal()
    {
        $this->addModal = false;
    }

    public function closeEditModal()
    {
        $this->editModal = false;
    }

    public function create()
    {
        // $this->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        Staff::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => bcrypt($this->password),
        ]);

        $this->success('Staff created successfully');

        $this->addModal = false;

        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function edit($id)
    {
        $staff = Staff::find($id);

        $this->id = $staff->id;
        $this->name = $staff->name;
        $this->email = $staff->email;

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        Staff::find($this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->success('Staff updated successfully');

        $this->editModal = false;
    }

    public function delete($id)
    {
        Staff::find($id)->delete();

        $this->success('Staff deleted successfully');
    }

    public function render()
    {
        return view('livewire.admin.view-staff');
    }
}
