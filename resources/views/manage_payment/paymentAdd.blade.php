<title>EPJK</title>
<x-app-layout>
    <br />
    <div class="container text-center">
        @if (isset($Jenazah) && $Jenazah != null):

        @else
            <h1 class="text-4xl">MANAGE KHAIRAT KEMATIAN</h1>
            <br />
            {{-- {{dd($kKematian)}} --}}
            <div class="container mx-auto px-4 bg-gray-200 rounded-3xl py-5 shadow-lg">
                <form method="POST" action="{{ route('store_payment') }}" enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-lg font-bold mb-4 text-left">DETAIL KEAHLIAN</h3>

                    <!--Hidden Input-->
                    <input type="hidden" value="{{ $user->userID }}" name="uid">
                    <input type="hidden" value="{{ $profile->phone }}" name="phone">
                    <input type="hidden" value="{{ $user->email }}" name="email">
                    @if ($kKematian === null || $kKematian->status == 'PENDING'):
                        <input type="hidden" value="Khairat Kematian Registration" name="service">
                    @else
                        <input type="hidden" value="Khairat Kematian Fee" name="service">
                    @endif

                    <!-- Flex row for input and label side by side -->
                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="no_kad_pengenalan" class="font-semibold text-left w-40">No. Kad Pengenalan</label>
                        <x-input id="no_kad_pengenalan" class="form-control w-96" type="text" name="noIC"
                            placeholder="No. Kad Pengenalan" value="{{ $profile->noIC }}" required autofocus readonly />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Nama</label>
                        <x-input id="nama" class="form-control w-96" type="text" name="name"
                            placeholder="Nama" value="{{ $user->name }}" required readonly />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="no_telefon" class="font-semibold text-left w-40">No. Ahli</label>
                        <x-input id="no_telefon" class="form-control w-96" type="text" name="kkID"
                            placeholder="No. Telefon" value="{{ $kKematian->kkID }}" required readonly />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="tarikh_lahir" class="font-semibold text-left w-40">Kadar Bayaran (RM)</label>
                        <x-input id="tarikh_lahir" class="form-control w-96" type="number" name="totalPayment"
                            step=".01" min="1"
                            value="{{ $kKematian->status != 'SUCCESSFUL' ? '210.00' : '50.00' }}" required readonly />
                    </div>

                    <h3 class="text-lg font-bold mt-4 text-left">KAEDAH BAYARAN</h3>
                    <div class="md:flex mb-6 ml-8">
                        <div class="md:w-3/3">
                            <div class="mt-2 flex">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-indigo-600" name="paymentOpt" required
                                        id="FPX" value="FPX">
                                    <img src="/images/FPX.png" alt="UMPSA" height="60px" width="100px"
                                        class="d-inline-block mx-2">
                                </label>
                            </div>
                            </br>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-indigo-600" name="paymentOpt"
                                        id="CDM" value="CDM">
                                    <label class="block text-gray-600 font-bold md:text-right mx-1">
                                        Cash Deposit Machine (CDM)
                                    </label>
                                </label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="60px"
                                    fill="currentColor" class="bi bi-cash-stack ml-14" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path
                                        d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div id="upload" style="display: none;">
                        <div class="w-64 ml-12">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file" name="receipt">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-5">
                        <a href="#" class="bg-red-500 text-white px-4 py-2 rounded w-48 text-center no-underline">
                            {{ __('TERMINATE ACCOUNT') }}
                        </a>
                        <x-button class="btn btn-primary w-48">
                            {{ __('SUBMIT') }}
                        </x-button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <br />
</x-app-layout>
