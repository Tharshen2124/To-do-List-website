<x-layout>
    <div class="mt-10 ml-10 mx-auto flex justify-center">
        <form method="POST" action="{{ route('updateRoute', $task) }}">
            @csrf
            @method('PATCH')
            <input 
            type="text" 
            class="bg-gray-200 px-2 py-1 rounded-lg focus:outline-none focus:border-gray-900 focus:ring focus:ring-blue-300 w-64
            disabled:opacity-25 transition"
            placeholder="enter task"
            value="{{ $task->tasks }}"
            name="task">
            {{-- <button class="nline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit"> Create </button>
            </div>
            <button class="transition ease-in-out delay-150 bg-blue-500  hover:bg-indigo-500 duration-200">
                Save Changes
            </button> --}}
        <button 
        type="submit" 
        class="bg-[#777] px-4 py-2 rounded-lg hover:transition duration-300 ease-in-out hover:bg-[#333] text-white"> Edit Task </button>
        {{-- <p>{{ $invalid }}</p> --}}
        </form>
        <a href="{{ route('mainRoute') }}" class="flex items-center border-2 border-solid border-[#333] px-2 py-1 rounded-lg hover:transition duration-300 ease-in-out hover:bg-[#333] hover:text-white ml-2 ">{{ __('Cancel') }}</a>
    </div>
</x-layout>