<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">MANAGE USER</h1>
            <h4 class="text-2xl">User List</h4>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <br />
        <a href="{{ route('users.create') }}" style="margin-left:45px;"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
            User</a>

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 font-medium text-gray-900">No.</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">User</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Created at</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $no++ }}</td>
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                    <div class="text-gray-400">{{ $user->email }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ $user->created_at }}</td>

                            <td class="px-6 py-4">{{ $user->role }}</td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-4">
                                    <button x-data="{ tooltip: 'View' }" alt="View" data-bs-toggle="modal" style="margin-bottom:10px"
                                        data-bs-target="#viewDetail{{ $user->userID }}" id="{{ $user->userID }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18"
                                            viewBox="0 0 576 512" stroke-width="1.5" stroke="currentColor"
                                            class="h-6 w-6" x-tooltip="tooltip">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                        </svg>
                                    </button>
                                    <a x-data="{ tooltip: 'Edit' }" href="{{ route('update_user', $user->userID) }}"
                                        alt="EDIT">
                                        <svg style="color: #007FFF;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                            x-tooltip="tooltip">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    <form x-data="{ tooltip: 'Delete' }" action="{{ route('users.destroy', $user->userID) }}"
                                        method="POST" type="button" alt="DELETE"
                                        onSubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button>
                                            <svg style="color: red;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="h-6 w-6" x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade modal-xl" id="viewDetail{{ $user->userID }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-12" style="font-size:14pt;">
                                                    @if ($profile->has($user->userID))
                                                        <label for="uid" class="col-form-label">User ID:</label>
                                                        <input type="text" class="form-control" id="uid"
                                                            value="{{ $user->userID }}" disabled readonly>
                                                        <label for="name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="name"
                                                            value="{{ $user->name }}" disabled readonly>

                                                        <label for="email" class="col-form-label">Email:</label>
                                                        <input type="text" class="form-control" id="email"
                                                            value="{{ $user->email }}" disabled readonly>

                                                        <label for="phone" class="col-form-label">Phone:</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            value="{{ $profile[$user->userID]->phone }}" disabled readonly>

                                                        <!-- NO IC and DOB side by side -->
                                                        <div class="row">
                                                            <!-- NO IC -->
                                                            <div class="col-md-6">
                                                                <label for="IC_NO" class="col-form-label">IC
                                                                    NO:</label>
                                                                <input type="text" class="form-control"
                                                                    id="IC_NO"
                                                                    value="{{ $profile[$user->userID]->noIC }}"
                                                                    disabled readonly>
                                                            </div>
                                                            <!-- DOB -->
                                                            <div class="col-md-6">
                                                                <label for="DOB"
                                                                    class="col-form-label">DOB:</label>
                                                                <input type="text" class="form-control"
                                                                    id="DOB"
                                                                    value="{{ $profile[$user->userID]->DOB }}"
                                                                    disabled readonly>
                                                            </div>
                                                        </div>

                                                        <!-- Nationality and Race side by side -->
                                                        <div class="row">
                                                            <!-- Nationality -->
                                                            <div class="col-md-6">
                                                                <label for="Nationality"
                                                                    class="col-form-label">Nationality:</label>
                                                                <input type="text" class="form-control"
                                                                    id="Nationality"
                                                                    value="{{ $profile[$user->userID]->nationality }}"
                                                                    disabled readonly>
                                                            </div>
                                                            <!-- Race -->
                                                            <div class="col-md-6">
                                                                <label for="Race"
                                                                    class="col-form-label">Race:</label>
                                                                <input type="text" class="form-control"
                                                                    id="Race"
                                                                    value="{{ $profile[$user->userID]->race }}"
                                                                    disabled readonly>
                                                            </div>
                                                        </div>

                                                        <!-- Role and Gender side by side -->
                                                        <div class="row">
                                                            <!-- Role -->
                                                            <div class="col-md-6">
                                                                <label for="Nationality"
                                                                    class="col-form-label">Role:</label>
                                                                <input type="text" class="form-control"
                                                                    id="Nationality" value="{{ $user->role }}"
                                                                    disabled readonly>
                                                            </div>
                                                            <!-- Gender -->
                                                            <div class="col-md-6">
                                                                <label for="Race"
                                                                    class="col-form-label">Gender:</label>
                                                                <input type="text" class="form-control"
                                                                    id="Race"
                                                                    value="{{ $profile[$user->userID]->gender }}"
                                                                    disabled readonly>
                                                            </div>
                                                        </div>

                                                        <label for="Address" class="col-form-label">Address:</label>

                                                        <textarea style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" class="form-control"
                                                            placeholder="Address" rows="3" name="address" disabled readonly>{{ $profile[$user->userID]->address }}</textarea>
                                                    @else
                                                        <label class="block mb-2 text-center">No Profile Found</label>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
