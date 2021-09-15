<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Candidates extends Component
{
	use WithPagination;

	public $searchCandidate;

    public function render()
    {
    	$query = '%'.$this->searchCandidate.'%';

    	return view('livewire.candidates', [
    		'users'		=>	User::where(function($sub_query){
    							$sub_query->where('first_name', 'like', '%'.$this->searchCandidate.'%')
    									  ->orWhere('middle_name', 'like', '%'.$this->searchCandidate.'%')
    									  ->orWhere('last_name', 'like', '%'.$this->searchCandidate.'%')
    									  ->orWhere('email', 'like', '%'.$this->searchCandidate.'%')
    									  ->orWhere('student_number', 'like', '%'.$this->searchCandidate.'%');
    						})->paginate(6)
    	]);
    }
}
