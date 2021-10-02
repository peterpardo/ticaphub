<div class="text-gray-800">
    <h1 class="font-bold text-center text-2xl">{{ $awardName }}</h1>
    <form wire:submit.prevent="setRubric">
            <div class="m-2">
                <label class="block font-semibold">Rubric</label>
                <select wire:model='selectedRubric' class="rounded w-full">
                    <option value="">-- select rubric --</option>
                    @foreach ($rubrics as $rubric)
                        <option value="{{ $rubric->id }}">{{ $rubric->name }}</option>
                    @endforeach
                </select>
                @error('selectedRubric')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            @if($selectedRubric)
                <div class="m-2">
                    <label class="block font-semibold">Criteria</label>
                    <table class="w-full border-collapse border border-black">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border-black border">Name</th>
                                <th class="border-black border">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criteria as $crit)
                            <tr>
                                <td class="border-black border text-center">{{ $crit->name }}</td>
                                <td class="border-black border text-center">{{ $crit->percentage }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="flex justify-evenly my-5">
                <button wire:click.prevent="$emit('closeRubricModal')" class="rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Submit</button>
            </div>
        </div>
    </form>
</div>
