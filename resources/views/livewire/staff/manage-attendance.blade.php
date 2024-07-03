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

                <x-menu-item title="Manage Attendance" icon="o-user-group" link="/staff/manage-attendance" />
                <x-menu-item title="View Reports" icon="o-bolt" link="/staff/view-reports" />
                <x-menu-item title="" icon="" link="" />
                <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                    <x-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-menu-sub>
            </x-menu>
        </x-slot:sidebar>

        <x-slot:content>

        @php
            $drivers = \App\Models\Children::all(); // Assuming you have a Children model
        
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'name', 'label' => 'Name'],
                ['key' => 'age', 'label' => 'Age'],
                ['key' => 'attendance_status', 'label' => 'Attendance Status'], // New column for attendance status
                ['key' => 'actions', 'label' => 'Actions'],
            ];
        @endphp
        
        <x-header title="Children Attendance" with-anchor separator />
        <x-table :headers="$headers" :rows="$drivers" striped>
            @foreach($drivers as $driver)
                @php
                    // Fetch the latest attendance record for the child
                    $latestAttendance = \App\Models\Attendance::where('child_id', $driver->id)->latest('date')->first();
                    $attendanceStatus = $latestAttendance && $latestAttendance->status == 1 ? 'Present' : 'Absent';
                @endphp
                @scope('attendance_status', $driver)
                    <div>{{ $attendanceStatus }}</div>
                @endscope
                @scope('actions', $driver)
                    <div class="flex">
                        <x-button icon="o-check" wire:click="present({{ $driver->id }})" spinner class="btn-sm" />
                        <x-button icon="o-x-mark" wire:click="absent({{ $driver->id }})" spinner class="btn-sm" />
                    </div>
                @endscope
            @endforeach
        </x-table>
        
        </x-slot:content>
    </x-main>
</div>
