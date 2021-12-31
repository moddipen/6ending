<?php

namespace App\Http\Livewire;
use App\Models\Matchtypeevent;
use Livewire\Component;
use Livewire\WithPagination;

class MatchtypeeventsIndex extends Component
{
    use WithPagination;
    public $searchTerm;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $events = Matchtypeevent::with(["event_types","match_types"])->paginate();    
        return view('livewire.matchtypeevent', compact('events'));
    }
}
