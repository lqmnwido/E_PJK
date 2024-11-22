<x-app-layout>

    {{-- @if($role=='FK Student' || $role=='Vendor') --}}
    <br />
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE KHAIRAT KEMATIAN</h1>
        <br />
        @if (Session::has('alert'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('alert') }}
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="container-fluid d-flex justify-content-evenly" style="padding-top:20px;">

            {{-- @if ($payment !== null || $application->status != 'Approved') --}}
                <a href="{{route('kKematian')}}"
                    class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">
                    <div class="flex flex-col items-center justify-center h-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0" />
                        </svg>
                        </br>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Register Khairat Kematian
                        </h5>
                    </div>
                </a>
            {{-- @else
                <a href="{#"
                    class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4 ">
                    <div class="flex flex-col items-center justify-center h-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0" />
                        </svg>
                        </br>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Registration Fee
                        </h5>
                    </div>
                </a>
            @endif --}}
            <a href="#"
                class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4 ">

                <div class="flex flex-col items-center justify-center h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24   " fill="currentColor"
                        class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                        <path
                            d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8" />
                    </svg>
                    </br>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Pay Fee Khairat Kematian</h5>
                </div>
            </a>
        </div>
    </div>
    {{-- @endif
    @if($role=='FK Bursary')
    <br />
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE PAYMENT</h1>
        <h4 class="text-2xl">FK Participant Page</h4>
        <br />
        @if (Session::has('alert'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('alert') }}
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="container-fluid d-flex justify-content-evenly" style="padding-top:10%;">
                <a href="{{ route('payments.index', ['type'=>'Registration Fee']) }}"
                    class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4 ">
                    <div class="flex flex-col items-center justify-center h-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0" />
                        </svg>
                        </br>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Registration Fee
                        </h5>
                    </div>
                </a>
            <a href="{{ route('payments.index', ['type'=>'Monthly Fee'])}}"
                class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">

                <div class="flex flex-col items-center justify-center h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24   " fill="currentColor"
                        class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                        <path
                            d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8" />
                    </svg>
                    </br>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Monthly Fee</h5>
                </div>
            </a>
        </div>
    </div>
    @endif --}}
</x-app-layout>
