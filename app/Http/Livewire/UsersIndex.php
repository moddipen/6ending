<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $users = User::whereHas('userprofile',function($q) {
            // Query the name field in status table
            $q->where('created_by',  auth()->user()->id); 
        })->where('name', 'like', $searchTerm)->Where('id', '!=', auth()->user()->id)->orderBy('id', 'desc')->with(['permissions', 'roles', 'providers'])->paginate();
        

        return view('livewire.users-index', compact('users'));
    }
}
