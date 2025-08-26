<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                <form action="{{ route('task.search') }}" method="POST" class="flex-1 max-w-md">
                    @csrf
                    <div class="relative">
                        <input type="search" name="search" id="search" value="{{ $search ?? '' }}"
                            class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg
                               bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700
                               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                               dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search tasks..." />
                        <button type="submit"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-white bg-blue-600 hover:bg-blue-700
                               focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg
                               text-sm px-4 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Search
                        </button>
                    </div>
                </form>


                <form action="{{ route('task.search') }}" method="POST" class="flex-1 max-w-xs">
                    @csrf
                    <div class="flex items-center gap-2">
                        <select name="status"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700
                               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                               dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" {{ empty($status) ? 'selected' : '' }}>All Status</option>
                            <option value="Pending" {{ isset($status) && $status == 'Pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="Active" {{ isset($status) && $status == 'Active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="Completed" {{ isset($status) && $status == 'Completed' ? 'selected' : '' }}>
                                Completed</option>

                        </select>
                        <button type="submit"
                            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none
                               focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2
                               dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Filter
                        </button>
                    </div>
                </form>


                <a href="{{ route('task.add') }}"
                    class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-medium text-white
                       bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none
                       focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600
                       dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    + Add Task
                </a>
            </div>




            <div class="py-12">


                @if (session('success'))
                    <div id="alert-border-3"
                        class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                        role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-border-3" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif




                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Discription
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created at
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Updated at
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $task->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $task->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('task.updateStatus', $task->id) }}" method="POST">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-blue-500 focus:border-blue-500 p-1.5
                   dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                <option value="Pending"
                                                    {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Active"
                                                    {{ $task->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Completed"
                                                    {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed
                                                </option>
                                            </select>
                                        </form>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $task->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->updated_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('task.edit', ['id' => $task->id]) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('task.delete', ['id' => $task->id]) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>




            </div>
        </div>
    </div>
</x-app-layout>
