<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  rounded-lg p-5">
                <form action="{{route('admin.permissions.update', $permission->id)}}" method="POST">
                    @csrf
                    @method('put')

                    <input type="text" class="rounded border-slate-300 bg-gray-200 " name="name" value="{{old('name', $permission->name)}}">
                    <button class="bg-indigo-500 p-2 rounded text-white">edit</button>
                </form>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  mt-5 p-4 rounded-lg">
                <h2 class="text-xl">Roles</h2>
                <div class="my-2 flex">
                    @if($permission->roles)
                    @foreach($permission->roles as $permission_role)
                    <form onsubmit="return confirm('sei sicuro di rimuovere il permesso?')" action="{{route('admin.roles.removeRole', [$permission->id, $permission_role->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="bg-gray-500 text-white rounded p-1 mx-1">{{$permission_role->name}}</button>
                    </form>
                    @endforeach
                    @endif
                </div>
                <div class="my-5">
                    <form action="{{route('admin.roles.assignRole', $permission->id)}}" method="POST">
                        @csrf
                        <select name="role" id="role" class="rounded  border-slate-300 bg-gray-200 ">
                            @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <button class="bg-indigo-500 p-2 rounded text-white">edit role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>