<meta name="csrf-token" content="{{ csrf_token() }}">

<x-app-layout>
    <br />
    @if ($role == 'Admin')
        <div class="container">
            <div class="text-center" style="margin-bottom:2%">
                <h1 class="text-4xl">MANAGE JENAZAH</h1>
            </div>
            @if (Session::has('Approve'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('Approve') }}
                </div>
            @endif
            @if (Session::has('Reject'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('Reject') }}
                </div>
            @endif
            <br />
            {{-- <a href="{{ route('application.create') }}" style="margin-left:45px;"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
            User</a> --}}

            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">No.</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Jenazah</th>
                            <th scope="col"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">Date & Time
                            </th>
                            <th scope="col" class="px-14 py-4 font-medium text-gray-900 break-words"
                                style="margin-left:-40px;">Status
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Action
                            </th>
                            <th scope="col"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">Assign
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @php
                            $no = 1;
                            $sortedJenazahs = $jenazahs->sortByDesc('updated_at');
                        @endphp
                        @foreach ($sortedJenazahs as $jenazah)
                            @php
                                $user = $users->where('userID', $jenazah->userID)->first();
                                $profile = $profiles->where('userID', $jenazah->userID)->first();
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ $no++ }}
                                </td>
                                <th class="flex gap-3 py-5 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $jenazah->jenazahName }}</div>
                                        <div class="text-gray-400">{{ $jenazah->jenazahIC }}</div>
                                    </div>
                                </th>
                                <td class="py-5 whitespace-nowrap overflow-hidden text-ellipsis text-center">
                                    {{ date('d/m/Y; h:iA', strtotime($jenazah->created_at)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis text-center">
                                    <div class="flex gap-4 text-center">
                                        @if ($jenazah->status == 'PENDING')
                                            <div class="px-6 py-4 text-grey-600 font-bold text-center">
                                                {{ __('PENDING') }}</div>
                                        @elseif ($jenazah->status == 'PROGRESS')
                                            <div class="px-6 py-4 text-blue-600 font-bold text-center">
                                                {{ __('PROGRESS') }}</div>
                                        @else
                                            <div class="px-4 py-4 text-green-600 font-bold text-center">
                                                {{ __('FINISHED') }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="flex justify-start gap-4" style="margin-right: 85px">
                                        <button x-data="{ tooltip: 'View' }" alt="View" data-bs-toggle="modal"
                                            data-bs-target="#viewDetail{{ $jenazah->id }}" id="{{ $jenazah->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18"
                                                viewBox="0 0 576 512" stroke-width="1.5" stroke="currentColor"
                                                class="h-6 w-6" x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                            </svg>
                                            <div class="flex justify-center" style="margin-right:18%;">
                                                {{ __('VIEW') }}</div>
                                            </a>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="flex gap-2">
                                        @if ($jenazah->assign)
                                            <div class="text-green-600 font-bold text-center px-6"
                                                style="margin-left: 50px">
                                                ASSIGNED TO: {{ $users->firstWhere('userID', $jenazah->assign)->name }}
                                            </div>
                                        @else
                                            <select class="mt-1 pengurus-select"
                                                style="width:100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
                                                data-jenazah-id="{{ $jenazah->id }}" required>
                                                <option value="">Select Pengurus Jenazah</option>

                                                @php
                                                    // Filter Pengurus Jenazah based on assignment status
                                                    $filteredUsers = $users->filter(function ($user) use ($jenazah) {
                                                        // Case 1: jenazah->assign is not null (exclude the assigned Pengurus)
                                                        if (!empty($jenazah->assign)) {
                                                            return $user->role === 'Pengurus Jenazah' &&
                                                                $user->userID !== $jenazah->assign;
                                                        }

                                                        // Case 2: jenazah->assign is null (show only Pengurus who are not assigned)
                                                        else {
                                                            // Ensure jenazahs relation exists and check if the Pengurus is assigned to any other Jenazah
                                                            return $user->role === 'Pengurus Jenazah' &&
                                                                (!$user->jenazahs ||
                                                                    !$user->jenazahs->contains(
                                                                        'assign',
                                                                        $user->userID,
                                                                    ));
                                                        }
                                                    });
                                                @endphp

                                                @foreach ($filteredUsers as $pengurus)
                                                    <option value="{{ $pengurus->userID }}">{{ $pengurus->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewDetail{{ $jenazah->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Jenazah Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Add fields you want to show here -->
                                                <div class="mb-3">
                                                    <strong>{{ __('No. Kad Pengenalan ') }}:</strong>
                                                    {{ $jenazah->jenazahIC }}
                                                </div>
                                                <div class="mb-3">
                                                    <strong>{{ __('Name ') }}:</strong> {{ $jenazah->jenazahName }}
                                                </div>
                                                <div class="mb-3">
                                                    <strong>{{ __('Tarikh Meninggal') }}:</strong>
                                                    {{ $jenazah->deathDate }}

                                                </div>
                                                <div class="mb-3">
                                                    <strong>{{ __('Location') }}:</strong> {{ $jenazah->location }}

                                                </div>
                                                <div class="mb-3">
                                                    <strong>{{ __('===============================================') }}</strong>
                                                </div>

                                                @php
                                                    // Find the waris (heir) in the profiles collection
                                                    $waris = $profiles->where('noIC', $profile->heir)->first();
                                                    // Initialize the waris_name variable
                                                    $waris_name = null;

                                                    // Check if $waris exists before accessing its properties
                                                    if ($waris) {
                                                        // Find the user based on the userID of the waris
                                                        $waris_name = $users->where('userID', $waris->userID)->first();
                                                    } else {
                                                        $waris_name = $users
                                                            ->where('userID', $jenazah->userID)
                                                            ->first();
                                                        $waris_ic = $profiles
                                                            ->where('userID', $jenazah->userID)
                                                            ->first();
                                                    }
                                                @endphp
                                                <div class="mb-3">
                                                    <strong>{{ __('No. IC Waris ') }}:</strong> {{ $waris_ic->noIC }}
                                                </div>
                                                <div class="mb-3">
                                                    <strong>{{ __('Nama Waris ') }}:</strong>
                                                    {{-- Check if $waris_name exists before displaying the name --}}
                                                    {{ $waris_name ? $waris_name->name : __('Unknown') }}
                                                </div>
                                                <div class="mb-3">
                                                    <strong>{{ __('===============================================') }}</strong>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>{{ __('IC Picture') }}:</strong>
                                                    <iframe
                                                        src="{{ asset('storage/application/' . $jenazah->permit) }}"
                                                        height="450px" width="100%"></iframe>
                                                </div>
                                                <!-- Add other details as necessary -->
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
    @else
        <div class="container">
            <div class="text-center" style="margin-bottom:2%">
                <h1 class="text-4xl">MANAGE JENAZAH</h1>
            </div>
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">No.</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Jenazah</th>
                            <th scope="col"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">Date & Time
                            </th>
                            <th scope="col" class="px-14 py-4 font-medium text-gray-900 break-words"
                                style="margin-left:-40px;">Status
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                style="padding-left:60px">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @php
                            $no = 1;
                            $sortedJenazahs = $jenazahs->sortByDesc('updated_at');
                        @endphp
                        @foreach ($sortedJenazahs as $jenazah)
                            @if ($jenazah->assign === $uid)
                                @php
                                    $user = $users->where('userID', $jenazah->userID)->first();
                                    $profile = $profiles->where('userID', $jenazah->userID)->first();
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                        {{ $no++ }}
                                    </td>
                                    <th class="flex gap-3 py-5 whitespace-nowrap overflow-hidden text-ellipsis">
                                        <div class="text-sm">
                                            <div class="font-medium text-gray-700">{{ $jenazah->jenazahName }}</div>
                                            <div class="text-gray-400">{{ $jenazah->jenazahIC }}</div>
                                        </div>
                                    </th>
                                    <td class="py-5 whitespace-nowrap overflow-hidden text-ellipsis text-center">
                                        {{ date('d/m/Y; h:iA', strtotime($jenazah->created_at)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis text-center">
                                        <div class="flex gap-4 text-center">
                                            @if ($jenazah->status == 'PENDING')
                                                <div class="px-6 py-4 text-grey-600 font-bold text-center">
                                                    {{ __('PENDING') }}</div>
                                            @elseif ($jenazah->status == 'PROGRESS')
                                                <div class="px-6 py-4 text-blue-600 font-bold text-center">
                                                    {{ __('PROGRESS') }}</div>
                                            @else
                                                <div class="px-4 py-4 text-green-600 font-bold text-center">
                                                    {{ __('FINISHED') }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-8 py-4">
                                        @if ($jenazah->status == 'PROGRESS')
                                            <div class="flex justify-start gap-4" style="margin-right: 85px">
                                            @elseif ($jenazah->status == 'COMPLETED')
                                                <div class="flex justify-start gap-4" style="padding-left: 35px">
                                        @endif
                                        <button x-data="{ tooltip: 'View' }" alt="View" data-bs-toggle="modal"
                                            data-bs-target="#viewDetail{{ $jenazah->id }}"
                                            id="{{ $jenazah->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18"
                                                viewBox="0 0 576 512" stroke-width="1.5" stroke="currentColor"
                                                class="h-6 w-6" x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                            </svg>
                                            <div class="flex justify-center" style="margin-right:18%;">
                                                {{ __('VIEW') }}</div>
                                            </a>
                                        </button>
                                        @if ($jenazah->status == 'PROGRESS')
                                            <button x-data="{ tooltip: 'Approve' }" alt="approve" data-bs-toggle="modal"
                                                data-bs-target="#locationSubmit{{ $jenazah->id }}"
                                                id="{{ $jenazah->id }}">
                                                <svg style="color: #007FFF; margin-left: 17px"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6" x-tooltip="tooltip">
                                                    <path
                                                        d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
                                                    <path
                                                        d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
                                                </svg>
                                                <div class="flex justify-center"
                                                    style="margin-right:50px; color: #007FFF;">
                                                    {{ __('FINISH') }}
                                                </div>
                                            </button>
                                        @endif
            </div>
            </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewDetail{{ $jenazah->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Jenazah Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add fields you want to show here -->
                                <div class="mb-3">
                                    <strong>{{ __('No. Kad Pengenalan ') }}:</strong>
                                    {{ $jenazah->jenazahIC }}
                                </div>
                                <div class="mb-3">
                                    <strong>{{ __('Name ') }}:</strong>
                                    {{ $jenazah->jenazahName }}
                                </div>
                                <div class="mb-3">
                                    <strong>{{ __('Tarikh Lahir') }}:</strong>
                                    {{ $jenazah->jenazahDOB }}

                                </div>
                                <div class="mb-3">
                                    <strong>{{ __('Tarikh Meninggal') }}:</strong>
                                    {{ $jenazah->deathDate }}
                                </div>
                                <div class="mb-3">
                                    <strong>{{ __('===============================================') }}</strong>
                                </div>
                                @php
                                    // Find the waris (heir) in the profiles collection
                                    $waris = $profiles->where('noIC', $profile->heir)->first();
                                    // Initialize the waris_name variable
                                    $waris_name = null;

                                    // Check if $waris exists before accessing its properties
                                    if ($waris) {
                                        // Find the user based on the userID of the waris
                                        $waris_name = $users->where('userID', $waris->userID)->first();
                                    }
                                @endphp
                                <div class="mb-3">
                                    <strong>{{ __('Services ') }}:</strong>
                                    <ol>
                                        @php
                                            $services = json_decode($jenazah->services, true);
                                        @endphp
                                        @if ($services)
                                            @foreach ($services as $service)
                                                <li>{{ $service }}</li>
                                            @endforeach
                                        @else
                                            <li>{{ __('No services available') }}</li>
                                        @endif
                                    </ol>
                                </div>
                                <div class="mb-3">
                                    <strong>{{ __('===============================================') }}</strong>
                                </div>
                                @php
                                    // Find the locationID in the jenazah collection
                                    $location = $locations->where('locationID', $jenazah->locationID)->first();
                                    // Initialize the location_id variable
                                    $location_id = null;
                                @endphp
                                {{-- // Check if $locationID exists before accessing its properties --}}
                                @if ($location)
                                    <div class="mb-3">
                                        <strong>{{ __('Lot ID') }}:</strong>
                                        {{ $jenazah->graveLot }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>{{ __('Location') }}:</strong>
                                        <div id="map-canvas" style="width: 100%; height: 400px;"></div>
                                        <input type="hidden" class="form-control w-96" name="lat"
                                            id="lat" value="{{ $location->latitude }}" />
                                        <input type="hidden" class="form-control w-96" name="lng"
                                            id="lng" value="{{ $location->longitude }}" />
                                    </div>
                                @endif

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

            <!-- Location Modal -->
            <div class="modal fade" id="locationSubmit{{ $jenazah->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <form action="location" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Job Confirmation
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add fields you want to show here -->
                                <div class="mb-3">
                                    <strong>{{ __('===============================================') }}</strong>
                                </div>
                                @php
                                    // Find the waris (heir) in the profiles collection
                                    $waris = $profiles->where('noIC', $profile->heir)->first();
                                    // Initialize the waris_name variable
                                    $waris_name = null;

                                    // Check if $waris exists before accessing its properties
                                    if ($waris) {
                                        // Find the user based on the userID of the waris
                                        $waris_name = $users->where('userID', $waris->userID)->first();
                                    }
                                @endphp
                                <div class="mb-3">
                                    <strong>{{ __('Services ') }}:</strong>
                                    <ol>
                                        @php
                                            $services = json_decode($jenazah->services, true);
                                        @endphp
                                        @if ($services)
                                            @foreach ($services as $service)
                                                <li>{{ $service }}</li>
                                            @endforeach
                                        @else
                                            <li>{{ __('No services available') }}</li>
                                        @endif
                                    </ol>
                                </div>
                                <div class="mb-3">
                                    <strong>{{ __('===============================================') }}</strong>
                                </div>
                                <input type="hidden" name="jenID" value="{{ $jenazah->jenazahID }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit"
                                    class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endif
    @endforeach
    </tbody>
    </table>
    </div>
    </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeSUIzJDIEuQqvUcmQapj1_k7BxCzYkAw&libraries=places&callback=initMap"
        async defer></script>

    <script>
        document.querySelectorAll('.pengurus-select').forEach(select => {
            select.addEventListener('change', function() {
                const jenazahId = this.getAttribute('data-jenazah-id');
                const pengurusId = this.value;

                if (pengurusId) {
                    fetch('{{ route('assign.jenazah') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                jenazah_id: jenazahId,
                                pengurus_id: pengurusId,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                location.reload(); // Reload to reflect changes
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error occurred:', error);
                            alert(`Error: ${error.message}`);
                        });
                }
            });
        });

        function initMap() {

            var latInput = document.getElementById('lat');
            var lat = parseFloat(latInput.value)
            var lngInput = document.getElementById('lng');
            var lng = parseFloat(lngInput.value)
            console.log(lat);
            console.log(lng);

            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {
                    lat: lat,
                    lng: lng
                },
                zoom: 19
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: lng
                },
                map: map,
                draggable: true
            });

            var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length === 0) {
                    console.log("No places found"); // Debugging output
                    return;
                }

                console.log("Places found:", places); // Debugging output

                var bounds = new google.maps.LatLngBounds();
                var i, place;

                for (i = 0;
                    (place = places[i]); i++) {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                }

                map.fitBounds(bounds);
                map.setZoom(19);
            });


            google.maps.event.addListener(marker, 'position_changed', function() {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                console.log("Lat: " + lat + ", Lng: " + lng); // Debugging output
                $('#lat').val(lat);
                $('#lng').val(lng);
            });

        }
    </script>

</x-app-layout>
