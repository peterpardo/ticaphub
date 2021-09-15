<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Filter extends Component
{
	use WithPagination;

	public $searchTerm;

    public function render()
    {
    	$query = '%'.$this->searchTerm.'%';

    	return view('livewire.filter', [
    		'users'		=>	User::where(function($sub_query){
    							$sub_query->where('first_name', 'like', '%'.$this->searchTerm.'%')
    									  ->orWhere('middle_name', 'like', '%'.$this->searchTerm.'%')
    									  ->orWhere('last_name', 'like', '%'.$this->searchTerm.'%')
    									  ->orWhere('email', 'like', '%'.$this->searchTerm.'%')
    									  ->orWhere('student_number', 'like', '%'.$this->searchTerm.'%');
    						})->paginate(6)
    	]);
    }
}