<div>
    <h1 class="text-center text-xl mb-3">{{ $election->name }}</h1>
    <form wire:submit.prevent='submitVote'>
        @foreach($positions as $position) 
        <div class="mb-3 w-1/5 mx-auto text-center">
            <div class="font-semibold text-xl border-b-2 border-gray-500 px-3 mb-2">{{ $position->name }}</div>
            <table class="mb-2 mx-auto">
                @foreach($election->candidates as $candidate) 
                    @if($candidate->position_id == $position->id)
                    <tr>
                        <td class="py-2 px-2">
                            <input type="radio" name="{{ $position->name }}" id="{{ $candidate->user->id }}" value="{{ Auth::user()->id }}">
                        </td>
                        <td class="py-2 px-2">
                            <label for="{{ $candidate->user->id  }}">{{ $candidate->user->last_name . ', ' .  $candidate->user->first_name . ' ' . $candidate->user->middle_name }}</label>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </table>
        </div>
        @endforeach
        <div class="text-center">
            <button type="submit" class="bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Send Vote</button>
        </div>
    </form>
</div>
