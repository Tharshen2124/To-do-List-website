<x-layout>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-white w-5/6 flex justify-center py-2 border-2 border-solid border-red-500 mt-4 mx-auto rounded-lg bg-red-500">You didn't enter your task!</p>
            @endforeach
        @endif
        <form method="POST" action="{{ route('saveItem') }}">
            <div class="mt-8 mx-auto flex justify-center items-center">
                @csrf
                <input 
                type="text" 
                class=" bg-gray-200 px-3 py-2 rounded-lg focus:outline-none focus:border-gray-900 focus:ring focus:ring-blue-300 w-72
                disabled:opacity-25 transition shadow-[inset_7px_7px_7px_#dbdbdb,_inset_-7px_-7px_7px_#fcfcfc]"
                placeholder="enter task"
                name="task">
                    
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#777777] ml-8 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                <select name="day" class="bg-gray-200 px-3 py-2 rounded-lg focus:outline-none focus:border-gray-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition shadow-[inset_7px_7px_7px_#dbdbdb,_inset_-7px_-7px_7px_#fcfcfc] text-[#555] mr-8">
                    <option value="today" name="today" class="px-3 py-1 rounded-lg focus:outline-none focus:border-gray-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition text-[#555]">Today</option>
                    <option value="tomorrow" name="tomorrow" class="px-3 py-1 rounded-lg focus:outline-none focus:border-gray-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition text-[#555]">Tomorrow</option>
                </select>
                    
                <button 
                type="submit" 
                class="shadow-[7px_7px_14px_#e2e2e2,_-7px_-7px_14px_#fafafa] px-4 py-[7px] rounded-lg hover:transition duration-300 ease-in-out text-[#444] hover:bg-[#333] hover:text-white ml-3"> Create Task </button>
            </div>
        </form>

    <div class="mt-10"></div>
    @foreach($tasks as $task)
    
                  <div class="flex w-5/6 justify-between items-center mx-auto px-10 py-4 my-1 rounded-lg shadow-[7px_7px_14px_#e2e2e2,_-7px_-7px_14px_#fafafa] my-5">
                    <p class="text-[#555]">{{ $task->tasks }}</p>
                   {{-- <p>{{ $task->created_at->format('Y-m-d H:i:s')}}</p> --}}

                   <div class="flex">
                    <form action="" class="flex">

                        @php
                           $diff = now()->diffForHumans($task->date_of_completion);
                        @endphp

                        @if ($task->date_of_completion->greaterThan($currentTime))
                            <x-time-layout>{{ $diff }}</x-time-layout> 
                        @else
                            <x-timeSecond-layout>{{ $diff }}</x-time-layout> 
                        @endif         

                    </form>
                    <form method="POST" action="{{ route('markComplete', $task->id) }}">
                        @csrf
                        <button class="ml-4 "> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8  text-[#777777] hover:text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </form>
                    <form action="{{ route('editRoute', $task) }}">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#777777] hover:text-blue-500 mx-3 ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                    </form>

                    <form action="{{ route('deleteRoute', $task->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#777777] hover:text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                    </div>
            </div>
    @endforeach
    <br>
    <hr>
    <br>
    @foreach($completedTasks as $completedTask)
    <div class="flex w-5/6 justify-between items-center mx-auto px-10 py-4 shadow-[7px_7px_14px_#e2e2e2,_-7px_-7px_14px_#fafafa] my-1 rounded-lg bg-gray-300 opacity-50">
        <p class=""><s>{{ $completedTask->tasks }}</s></p>  
            <form action="{{ route('deleteRoute', $completedTask->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 hover:text-red-500 ">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </form>
    </div>
    @endforeach 
</x-layout>