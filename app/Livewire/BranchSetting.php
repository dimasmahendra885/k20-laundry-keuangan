<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Branch;

class BranchSetting extends Component
{
    public $branch_id;
    public $nama;
    public $target_daily;
    public $target_weekly;
    public $target_monthly;

    public function mount()
    {
        $branch = auth()->user()->branch;

        if ($branch) {
            $this->branch_id = $branch->id;
            $this->nama = $branch->nama;
            $this->target_daily = $branch->target_daily;
            $this->target_weekly = $branch->target_weekly;
            $this->target_monthly = $branch->target_monthly;
        }
    }

    public function update()
    {
        $this->validate([
            'target_daily' => 'nullable|numeric|min:0',
            'target_weekly' => 'nullable|numeric|min:0',
            'target_monthly' => 'nullable|numeric|min:0',
        ]);

        $user = auth()->user();

        // 1. Auto-Create/Assign Branch logic
        if (!$user->branch_id) {
            $branch = Branch::firstOrCreate(
                ['nama' => 'Cabang Pusat'],
                ['alamat' => 'Alamat Pusat']
            );
            
            $user->update(['branch_id' => $branch->id]);
            $user->load('branch');
            $this->nama = $branch->nama;
        }

        $branch = $user->branch;

        // 2. Bi-Directional Smart Auto-Calculation Logic
        $daily = $this->target_daily;
        $weekly = $this->target_weekly;
        $monthly = $this->target_monthly;

        if ($monthly && !$daily && !$weekly) {
            $daily = round($monthly / 30);
            $weekly = round($monthly / 4);
        } elseif ($daily && !$weekly && !$monthly) {
            $weekly = round($daily * 7);
            $monthly = round($daily * 30);
        } elseif ($weekly && !$daily && !$monthly) {
            $daily = round($weekly / 7);
            $monthly = round($weekly * 4);
        }

        $this->target_daily = $daily;
        $this->target_weekly = $weekly;
        $this->target_monthly = $monthly;

        // 3. Save Data Target
        $branch->update([
            'target_daily' => $this->target_daily ?: 0,
            'target_weekly' => $this->target_weekly ?: 0,
            'target_monthly' => $this->target_monthly ?: 0,
        ]);

        session()->flash('message', 'Target finansial cabang Anda berhasil diperbarui!');
    }

    protected function messages()
    {
        return [
            'target_daily.numeric' => 'Harus berupa angka minimal 0.',
            'target_weekly.numeric' => 'Harus berupa angka minimal 0.',
            'target_monthly.numeric' => 'Harus berupa angka minimal 0.',
            'target_daily.min' => 'Harus berupa angka minimal 0.',
            'target_weekly.min' => 'Harus berupa angka minimal 0.',
            'target_monthly.min' => 'Harus berupa angka minimal 0.',
        ];
    }

    public function render()
    {
        return view('livewire.branch-setting');
    }
}
