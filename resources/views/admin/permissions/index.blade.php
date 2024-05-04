<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-end my-3">
                <a href="{{route('admin.permissions.create')}}" class="bg-gray-300 rounded p-2 shadow">Crea Permesso</a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  rounded-lg">
                <!-- component -->
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="bg-white border-b">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                name
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $permission)
                                        <tr class="border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{$permission->name}}
                                            </td>
                                            <td class="text-sm flex text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <a class="bg-indigo-700 me-2 p-1 rounded text-white" href="{{route('admin.permissions.edit', $permission->id)}}">edit</a>
                                                <form action="{{route('admin.permissions.destroy', $permission->id)}}" method="POST" >
                                                    @csrf
                                                    @method('delete')
                                                    <button class="bg-red-700 p-1 rounded text-white">delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>