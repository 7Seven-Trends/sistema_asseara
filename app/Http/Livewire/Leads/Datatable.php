<?php

namespace App\Http\Livewire\Leads;

use Livewire\Component;
use App\Models\Leads;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;
    
    public function render()
    {
        $leads = Leads::orderBy("created_at", "DESC")->paginate(20);
        return view('livewire.leads.datatable', ["leads" => $leads]);
    }
}
