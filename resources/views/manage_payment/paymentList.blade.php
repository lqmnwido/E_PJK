<x-app-layout>
    <br />
    @if ($role == 'Admin')
        <div class="container">
            <div class="text-center" style="margin-bottom:2%">
                <h1 class="text-4xl">MANAGE PAYMENT</h1>
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
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Details</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Date & Time
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 break-words">Type Of Payment
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Amount (RM)
                            </th>
                            <th scope="col" class="px-16 py-4 font-medium text-gray-900 whitespace-nowrap">Status
                            </th>
                            <th scope="col" class="px-24 py-4 font-medium text-gray-900 whitespace-nowrap">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @php
                            $no = 1;
                            $sortedPayments = $payments->sortByDesc('updated_at');
                        @endphp
                        @foreach ($sortedPayments as $payment)
                            @php
                                $user = $users->where('userID', $payment->userID)->first();
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ $no++ }}
                                </td>
                                <th class="flex gap-3 px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                        <div class="text-gray-400">{{ $payment->services }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ date('d/m/Y; h:iA', strtotime($payment->updated_at)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis text-center">
                                    {{ $payment->typeOfPayment }}</td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="flex gap-2">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                            {{ 'RM ' . number_format((float) $payment->amount, 2) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="flex gap-4">
                                        @if ($payment->status == 'REJECTED')
                                            <div class="px-8 py-4 text-red-600 font-bold">
                                                {{ __('REJECTED') }}</div>
                                        @elseif($payment->status == 'APPROVED')
                                            <div class="px-8 py-4 text-green-600 font-bold">
                                                {{ __('APPROVED') }}</div>
                                        @elseif($payment->status == 'UNSUCCESSFUL')
                                            <div class="px-3 py-4 text-red-600 font-bold">
                                                {{ __('UNSUCCESSFUL') }}</div>
                                        @elseif($payment->status == 'PENDING')
                                            <div class="px-8 py-4 text-grey-600 font-bold">
                                                {{ __('PENDING') }}</div>
                                        @else
                                            <div class="px-4 py-4 text-green-600 font-bold">
                                                {{ __('SUCCESSFUL') }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    @if ($payment->status == 'UNSUCCESSFUL' || $payment->status == 'SUCCESSFUL')
                                    @else
                                        <div class="flex justify-end gap-4" style="margin-right: 85px">
                                            @if ($payment->status == 'APPROVED' || $payment->status == 'REJECTED')
                                                <button x-data="{ tooltip: 'View' }" alt="View" data-bs-toggle="modal"
                                                    data-bs-target="#viewPayment{{ $payment->id }}"
                                                    id="{{ $payment->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                        width="18" viewBox="0 0 576 512" stroke-width="1.5"
                                                        stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                    </svg>
                                                    <div class="flex justify-center" style="margin-right:18%;">
                                                        {{ __('VIEW') }}</div>
                                                    </a>
                                                </button>
                                            @else
                                                <button x-data="{ tooltip: 'View' }" alt="View" data-bs-toggle="modal"
                                                    data-bs-target="#viewPayment{{ $payment->id }}"
                                                    id="{{ $payment->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                        width="18" viewBox="0 0 576 512" stroke-width="1.5"
                                                        stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                    </svg>
                                                    <div class="flex justify-center" style="margin-right:18%;">
                                                        {{ __('VIEW') }}</div>
                                                    </a>
                                                </button>
                                                <button x-data="{ tooltip: 'Approve' }" alt="approve" data-bs-toggle="modal"
                                                    data-bs-target="#approvePayment{{ $payment->id }}"
                                                    id="{{ $payment->id }}">
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
                                                        style="margin-right:20%; color: #007FFF;">
                                                        {{ __('APPROVE') }}
                                                    </div>
                                                </button>
                                                <button x-data="{ tooltip: 'Delete' }" alt="DELETE" data-bs-toggle="modal"
                                                    data-bs-target="#RejectPayment{{ $payment->id }}"
                                                    id="{{ $payment->id }}">
                                                    <svg style="color: red; margin-left: 5px"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="h-6 w-6" x-tooltip="tooltip">
                                                        <path
                                                            d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z" />
                                                        <path
                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                    </svg>
                                                    <div class="flex justify-center"
                                                        style="margin-right:50%; color: red;">
                                                        {{ __('REJECT') }}
                                                    </div>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>

                            <!-- Approve Modal -->
                            <div class="modal fade" id="approvePayment{{ $payment->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('approve') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Approve Payment
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row align-items-center my-3">
                                                    <div class="col-md-12" style="font-size:14pt;">
                                                        <label class="block mb-2 text-center">Are you sure want to
                                                            approve?</label>
                                                        </br>
                                                        Payment ID : {{ $payment->paymentID }}
                                                        <input type="text" name="type"
                                                            value="{{ $role }}" hidden>
                                                        <input type="text" class="id" name="id"
                                                            value="{{ $payment->paymentID }}" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit"
                                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="RejectPayment{{ $payment->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('reject') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reject Payment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row align-items-center my-3">
                                                    <div class="col-md-12" style="font-size:14pt;">
                                                        <label class="block mb-2 text-center">Are you sure want to
                                                            reject?</label>
                                                        </br>
                                                        <label for="reason"
                                                            class="block mb-2 text-sm font-medium">Reason</label>
                                                        <textarea id="reason" name="reason" rows="4"
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-slate-300 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Write your reason here..."></textarea>
                                                        <input type="text" class="id" name="id"
                                                            value="{{ $payment->paymentID }}" hidden>
                                                        <input type="text" name="type"
                                                            value="{{ $payment->paymentID }}" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit"
                                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewPayment{{ $payment->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="#" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reject Payment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row align-items-center my-3">
                                                    <div class="col-md-12" style="font-size:14pt;">
                                                        <label
                                                            class="block mb-2 text-center">{{ $payment->paymentID }}</label>
                                                        </br>
                                                    </div>
                                                    <iframe src="{{ asset('storage/receipt/' . $payment->receipt) }}"
                                                        height="500px" width="500px"></iframe>
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
    @else
        <div class="container">
            <div class="text-center" style="margin-bottom:2%">
                <h1 class="text-4xl">MANAGE PAYMENT</h1>
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
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Details</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Date &
                                Time
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 break-words">Type Of Payment
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Amount
                                (RM)
                            </th>
                            <th scope="col" class="px-16 py-4 font-medium text-gray-900 whitespace-nowrap">Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @php
                            $no = 1;
                            $sortedPayments = $payments->sortByDesc('updated_at');
                        @endphp
                        @foreach ($sortedPayments as $payment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ $no++ }}
                                </td>
                                <th class="flex gap-3 px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                        <div class="text-gray-400">{{ $payment->services }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ date('d/m/Y; h:iA', strtotime($payment->updated_at)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis text-center">
                                    {{ $payment->typeOfPayment }}</td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="flex gap-2">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                            {{ 'RM ' . number_format((float) $payment->amount, 2) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis">
                                    <div class="flex gap-4">
                                        @if ($payment->status == 'REJECTED')
                                            <div class="px-8 py-4 text-red-600 font-bold">
                                                {{ __('REJECTED') }}</div>
                                        @elseif($payment->status == 'APPROVED')
                                            <div class="px-8 py-4 text-green-600 font-bold">
                                                {{ __('APPROVED') }}</div>
                                        @elseif($payment->status == 'UNSUCCESSFUL')
                                            <div class="px-3 py-4 text-red-600 font-bold">
                                                {{ __('UNSUCCESSFUL') }}</div>
                                        @elseif($payment->status == 'PENDING')
                                            <div class="px-8 py-4 text-grey-600 font-bold">
                                                {{ __('PENDING') }}</div>
                                        @else
                                            <div class="px-6 py-4 text-green-600 font-bold">
                                                {{ __('SUCCESSFUL') }}</div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-app-layout>
