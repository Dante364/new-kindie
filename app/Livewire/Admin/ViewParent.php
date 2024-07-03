<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Parents;
use Mary\Traits\Toast;

class ViewParent extends Component
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

        Parents::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => bcrypt($this->password),
        ]);

        $this->success('Parent created successfully');

        $this->addModal = false;

        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function edit($id)
    {
        $parent = Parents::find($id);

        $this->id = $parent->id;
        $this->name = $parent->name;
        $this->email = $parent->email;
        $this->phone = $parent->phone;

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        Parents::find($this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->success('Parent updated successfully');

        $this->editModal = false;
    }

    public function delete($id)
    {
        Parents::find($id)->delete();

        $this->success('Parent deleted successfully');
    }
    
    public function render()
    {
        return view('livewire.admin.view-parent');
    }
}
