<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  rounded-lg p-5">
                <form action="{{route('admin.permissions.store')}}" method="POST">
                    @csrf
 
                    <input class="rounded border-slate-300 bg-gray-200 " type="text" name="name">
                    <button class="bg-indigo-500 p-2 rounded text-white">create</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>