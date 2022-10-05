<?php

namespace App\Http\Livewire\Newsletter;

use Livewire\Component;
use App\Models\Newsletter;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;
    
    public function render()
    {
        $newsletters = Newsletter::orderBy("created_at", "DESC")->paginate(20);
        return view('livewire.newsletter.datatable', ["newsletters" => $newsletters]);
    }
}
