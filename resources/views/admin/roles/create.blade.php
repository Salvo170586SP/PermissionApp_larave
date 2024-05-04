<x-admin-layout>
    <div class="py-12 w-full">
        <div class="mx-5" x-data="{ isActive: true }">
            @if(session()->has('message'))
            <div x-show="isActive == true"
                class="p-4 mb-4 w-full mx-auto flex justify-between rounded-lg bg-green-100 text-green-800">
                <div class="text-sm">
                    <span>{{session('message')}}</span>
                </div>
                <button x-on:click="isActive = false">X</button>
            </div>
            @endif
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  rounded-lg">
                <form action="{{route('admin.roles.store')}}" method="POST">
                    @csrf
 
                    <input class="rounded border-slate-300 bg-gray-200 " type="text" name="name">
                    <button class="bg-indigo-500 p-2 rounded text-white">create</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>