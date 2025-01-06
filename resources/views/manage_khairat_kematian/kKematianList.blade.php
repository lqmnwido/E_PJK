<x-app-layout>
    <br />
    @if ($role == 'Admin')
        <div class="container">
            <div class="text-center" style="margin-bottom:2%">
                <h1 class="text-4xl">MANAGE KHAIRAT KEMATIAN</h1>
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

            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">No.</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">User</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Application
                                Date</th>
                            <th scope="col" class="px-16 py-4 font-medium text-gray-900 whitespace-nowrap">Status
                            </th>
                            <th scope="col" class="px-24 py-4 font-medium text-gray-900 whitespace-nowrap">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @php
                            $no = 1;
                            $sortedkKematians = $kKematians->sortByDesc('updated_at');
                        @endphp
                        @foreach ($sortedkKematians as $kKematian)
                            @php
                                $user = $users->where('userID', $kKematian->userID)->first();
                                $profile = $profiles->where('userID', $kKematian->userID)->first();
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ $no++ }}
                                </td>
                                <th class="flex gap-3 px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                        <div class="text-gray-400">{{ $user->email }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ date('d/m/Y; h:iA', strtotime($kKematian->updated_at)) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="flex gap-4">
                                        @if ($kKematian->status == 'REJECTED')
                                            <div class="px-8 py-4 text-red-600 font-bold">
                                                {{ __('REJECTED') }}</div>
                                        @elseif($kKematian->status == 'APPROVED')
                                            <div class="px-8 py-4 text-green-600 font-bold">
                                                {{ __('APPROVED') }}</div>
                                        @elseif($kKematian->status == 'UNSUCCESSFUL')
                                            <div class="px-3 py-4 text-red-600 font-bold">
                                                {{ __('UNSUCCESSFUL') }}</div>
                                        @elseif($kKematian->status == 'PENDING')
                                            <div class="px-8 py-4 text-grey-600 font-bold">
                                                {{ __('PENDING') }}</div>
                                        @else
                                            <div class="px-4 py-4 text-green-600 font-bold">
                                                {{ __('SUCCESSFUL') }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="flex justify-center gap-4" style="margin-right: 95px">
                                        <button x-data="{ tooltip: 'View' }" alt="View" data-bs-toggle="modal"
                                            data-bs-target="#viewDetail{{ $kKematian->id }}"
                                            id="{{ $kKematian->id }}">
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
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewDetail{{ $kKematian->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="viewDetailLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewDetailLabel">
                                                {{ __('View Application Details') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add fields you want to show here -->
                                            <div class="mb-3">
                                                <strong>{{ __('No. Kad Pengenalan ') }}:</strong> {{ $profile->noIC }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('Name ') }}:</strong> {{ $user->name }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('No. Telefon ') }}:</strong> {{ $profile->phone }}
                                                
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('=======================================================') }}</strong>
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
                                                <strong>{{ __('No. IC Waris ') }}:</strong> {{ $profile->heir }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('Nama Waris ') }}:</strong>
                                                {{-- Check if $waris_name exists before displaying the name --}}
                                                {{ $waris_name ? $waris_name->name : __('Unknown') }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('=======================================================') }}</strong>
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('IC Picture') }}:</strong>
                                                <iframe
                                                    src="{{ asset('storage/application/' . $kKematian->pictureIC) }}"
                                                    height="450px" width="100%"></iframe>
                                            </div>
                                            <!-- Add other details as necessary -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal{{ $kKematian->id }}" tabindex="-1"
                                aria-labelledby="rejectModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel">
                                                {{ __('Reject Application') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('kKematian_reject', $kKematian->id) }}">
                                            @csrf
                                            <div class="modal-body">
                                                <label for="reason"
                                                    class="form-label">{{ __('Reason for Rejection') }}</label>
                                                <textarea class="form-control" name="reason" rows="4" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ __('Reject') }}</button>
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
    @endif
</x-app-layout>
