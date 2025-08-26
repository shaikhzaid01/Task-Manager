<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="max-w-sm mx-auto p-5"
                      action="{{ route('task.update', ['id' => $task->id]) }}"
                      method="POST">
                    @csrf

                    {{-- Task Title --}}
                    <div class="mb-5">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Task Title</label>
                        <input type="text" id="title" name="title" value="{{ $task->title }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter Task Title" required />
                    </div>

                    {{-- Task Description --}}
                    <div class="mb-5">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Task Description</label>
                        <input type="text" id="description" name="description" value="{{ $task->description }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter Task Description" />
                    </div>

                    {{-- Task Status --}}
                    <div class="mb-5">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Task Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Active" {{ $task->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                               focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto
                               px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700
                               dark:focus:ring-blue-800">
                        Update Task
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
