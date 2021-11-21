<div class="mb-5">
    <h1 class="text-start font-bold text-2xl">Tasks</h1>
    @if($user->committeeTasks()->count() == 0)
        <div class="bg-gray-100 text-center py-6 rounded">No Tasks Assigned To You</div>
    @else
        @foreach($user->committeeTasks()->orderBy('updated_at', 'desc')->get() as $task)
        <div class="relative lg:flex shadow rounded-lg border-gray-400 my-5">
            @if(!$task->pivot->is_read)
                <span class="absolute -top-4 -left-3 text-white bg-green-500 w-auto px-2 py-1 rounded shadow">NEW</span>
            @endif
            <div class="bg-red-500 dark:bg-gray-800  rounded-lg lg:w-2/12 py-4 block h-full shadow-inner">
                <div class="text-center tracking-wide">
                    <div class="text-white font-bold text-4xl ">{{ $task->created_at->format('M') }}</div>
                    <div class="text-white font-normal text-2xl">{{ $task->created_at->format('j') }}</div>
                </div>
            </div>
            <div class="w-full lg:w-11/12 xl:w-full px-1 rounded bg-white dark:bg-gray py-5 lg:px-2 lg:py-2 tracking-wide">
                <div class="flex flex-row lg:justify-start justify-center">
                    <div class="text-gray-700 font-medium text-sm text-center lg:text-left px-2">
                        Created by:
                    </div>
                    <div class="text-gray-700 font-medium text-sm text-center lg:text-left px-2">
                        {{ $task->committee->name }}
                    </div>
                </div>
                <div class="font-semibold text-gray-800 text-xl text-center lg:text-left px-2">
                    {{ $task->title }}
                </div>
                <div class="text-gray-600 font-medium text-sm pt-1 text-center lg:text-left px-2">
                    Status: <span class="font-semibold">{{ $task->status }}</span>
                </div>
            </div>
            <div class="flex flex-row items-center w-full lg:w-1/3 bg-white lg:justify-end justify-center px-2 py-2 lg:px-0">
                <div class="flex flex-col">
                    <span class="tracking-wider text-gray-600 bg-gray-200 px-2 text-sm rounded leading-loose mx-2 font-semibold">
                        {{ $task->updated_at->diffForHumans() }}
                    </span>
                    <a href="/committee/{{ $task->committee->id }}/task/{{ $task->id }}/view-task" class="text-center py-1 px-2 rounded mt-4 mx-2 bg-red-500 text-white">View more</a>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

