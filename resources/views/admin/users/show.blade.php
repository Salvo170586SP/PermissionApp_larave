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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  rounded-lg p-3">
                {{$user->name}}
                {{$user->email}}
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  mt-5 p-4 rounded-lg">
                <h2 class="text-xl">Role</h2>
                <div class="my-2 flex">
                    @if($user->roles)
                    @foreach($user->roles as $user_role)
                    <form onsubmit="return confirm('sei sicuro di rimuovere il ruolo?')"
                        action="{{route('admin.users.removeRole', [$user->id, $user_role->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="bg-gray-500 text-white rounded p-1 mx-1">{{$user_role->name}}</button>
                    </form>
                    @endforeach
                    @endif
                </div>
                <div class="my-5">
                    <form action="{{route('admin.users.assignRole', $user->id)}}" method="POST">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg  mt-5 p-4 rounded-lg">
                <h2 class="text-xl">Permission</h2>
                <div class="my-2 flex">
                    @if($user->permissions)
                    @foreach($user->permissions as $user_permission)
                    <form onsubmit="return confirm('sei sicuro di rimuovere il permesso?')"
                        action="{{route('admin.users.revokePermission', [$user->id, $user_permission->id])}}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button class="bg-gray-500 text-white rounded p-1 mx-1">{{$user_permission->name}}</button>
                    </form>
                    @endforeach
                    @endif
                </div>
                <div class="my-5">
                    <form action="{{route('admin.users.givePermission', $user->id)}}" method="POST">
                        @csrf
                        <select name="permission" id="permission" class="rounded  border-slate-300 bg-gray-200 ">
                            @foreach($permissions as $permission)
                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                        <button class="bg-indigo-500 p-2 rounded text-white">edit permission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>