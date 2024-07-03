<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Children;
use Mary\Traits\Toast;

class ViewChildren extends Component
{
    use Toast;

    public $name, $age, $id;

    public bool $addModal = false;
    public bool $editModal = false;

    public $parents_id;

    public function openCreateModal()
    {
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
        $this->validate([
            'name' => 'required',
            'age' => 'required',
            // 'parents_id' => 'required|exists:parents,id', // Ensure parents_id is provided and exists in the parents table
        ]);

        Children::create([
            'name' => $this->name,
            'age' => $this->age,
            // 'parents_id' => $this->parents_id, // Include parents_id in the creation
        ]);

        $this->success('Child created successfully');

        $this->addModal = false;

        $this->name = '';
        $this->age = '';
        // $this->parents_id = null; // Reset parents_id or handle as needed
    }

    public function edit($id)
    {
        $child = Children::find($id);

        $this->name = $child->name;
        $this->age = $child->age;
        $this->id = $id;

        $this->editModal = true;
    }

    public function delete($id)
    {
        Children::find($id)->delete();

        $this->success('Child deleted successfully');
    }

    public function update()
    {
        $id = $this->id;
        $this->validate([
            'name' => 'required',
            'age' => 'required',
        ]);

        $child = Children::find($id);

        $child->update([
            'name' => $this->name,
            'age' => $this->age,
        ]);

        $this->success('Child updated successfully');

        $this->name = '';
        $this->age = '';

        $this->editModal = false;
    }

    public function render()
    {
        return view('livewire.admin.view-children');
    }
}
