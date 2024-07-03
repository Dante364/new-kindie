<div>
    <x-nav sticky full-width>
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <div>Kindy-Joy</div>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-theme-toggle darkTheme="coffee" lightTheme="retro" />
            <x-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
            <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-nav>

    <x-main>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">
 
            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="Home" icon="o-sparkles" link="/admin/home" />
                <x-menu-item title="View Children" icon="o-user-group" link="/admin/view-children" />
                <x-menu-item title="View Staff" icon="o-user" link="/admin/view-staff" />
                <x-menu-item title="View Parent" icon="o-user" link="/admin/view-parent" />
            </x-menu>
        </x-slot:sidebar>

        <x-slot:content>
        @php
            $drivers = \App\Models\Staff::all();

            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'name', 'label' => 'Name'],
                ['key' => 'email', 'label' => 'E-mail Address'],
                ['key' => 'phone', 'label' => 'Phone'],
                ['key' => 'actions', 'label' => 'Actions'],
            ];
        @endphp

        <x-header title="Staff" with-anchor separator />
        <x-button label="Add Staff" icon="o-plus" wire:click="openCreateModal" class="btn-primary" />
        <x-table :headers="$headers" :rows="$drivers" striped>
            @foreach($drivers as $driver)
                @scope('actions', $driver)
                <div class="flex">
                    <x-button icon="o-trash" wire:click="delete({{ $driver->id }})" spinner class="btn-sm" />
                    <x-button icon="o-pencil" wire:click="edit({{ $driver->id }})" spinner class="btn-sm" />
                </div>
                @endscope
            @endforeach
        </x-table>

        <x-modal wire:model="editModal" title="Add Staff">
            <x-form wire:submit="update">
                <x-input label="Name"  wire:model="name" />
                <x-input label="Email"  wire:model="email" />
                <x-input label="Phone" wire:model="phone" />
                
                <x-slot:actions>
                    <x-button label="Cancel" wire:click="closeEditModal" class="btn-ghost" />
                    <x-button type="submit" label="Save" class="btn-primary" />
                </x-slot:actions>
            </x-form>
        </x-modal>

        <x-modal wire:model="addModal" title="Add Staff">
            <x-form wire:submit="create">
                <x-input label="Name"  wire:model="name" />
                <x-input label="Email"  wire:model="email" />
                <x-input label="Phone"  wire:model="phone" />
                <x-input label="Password" type="password" wire:model="password" />
                
                <x-slot:actions>
                    <x-button label="Cancel" wire:click="closeAddModal" class="btn-ghost" />
                    <x-button type="submit" label="Save" class="btn-primary" />
                </x-slot:actions>
            </x-form>
        </x-modal>
        </x-slot:content>
    </x-main>
</div>
