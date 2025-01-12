<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<x-app-layout>
    <br />
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="text-4xl font-bold">MANAGE KHAIRAT KEMATIAN</h1>
        </div>

        <div class="container mx-auto px-4 bg-gray-200 rounded-3xl py-5 shadow-lg">
            <form method="POST" action="{{ route('kKematian.store') }}" enctype="multipart/form-data">
                @csrf
                <h3 class="text-lg font-bold mb-4">BORANG KEAHLIAN</h3>

                <input type="hidden" value="{{$user->userID}}" name="uid">

                <!-- Flex row for input and label side by side -->
                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="no_kad_pengenalan" class="font-semibold text-left w-40">No. Kad Pengenalan*</label>
                    <x-input id="no_kad_pengenalan" class="form-control w-96" type="text" name="noIC"
                        placeholder="No. Kad Pengenalan" value="{{ $profile->noIC }}" required autofocus />
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="nama" class="font-semibold text-left w-40">Nama*</label>
                    <x-input id="nama" class="form-control w-96" type="text" name="name" placeholder="Nama"
                    value="{{ $user->name }}" required />
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="no_telefon" class="font-semibold text-left w-40">No. Telefon*</label>
                    <x-input id="no_telefon" class="form-control w-96" type="text" name="phone"
                        placeholder="No. Telefon" value="{{ $profile->phone }}" required />
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="tarikh_lahir" class="font-semibold text-left w-40">Tarikh Lahir*</label>
                    <x-input id="tarikh_lahir" class="form-control w-96" type="date" name="DOB" value="{{ $profile->DOB }}" required />
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="nama_waris" class="font-semibold text-left w-40">No. IC Waris*</label>
                    <x-input id="nama_waris" class="form-control w-96" type="text" name="nama_waris"
                        placeholder="No. IC Waris" value="{{ $profile->heir }}"  required />
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="no_telefon_waris" class="font-semibold text-left w-40">No. Telefon Waris*</label>
                    <x-input id="no_telefon_waris" class="form-control w-96" type="text" name="phone_waris"
                        placeholder="No. Telefon Waris" required />
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="gambar_ic" class="font-semibold text-left w-40">Gambar IC*</label>
                    <input id="gambar_ic" class="form-control w-96" type="file" name="icPic" accept="image/*" required/>
                </div>

                <h3 class="text-lg font-bold mt-4 text-left">YURAN AHLI</h3>
                <h5 class="font-bold ml-8">RM 210 (Pendaftaran : RM10.00 + Yuran tahunan : RM50.00 + Yuran tambahan : RM150.00)</h5>
                <p class="text-sm ml-8">(RINGGIT MALAYSIA: DUA RATUS SEPULUH SAHAJA)</p>

                <div class="form-check mt-3 flex items-center justify-center ml-8">
                    <input class="form-check-input" type="checkbox" id="terms_conditions" required>
                    <label class="form-check-label ml-2" for="terms_conditions">
                        Agree to terms and conditions
                    </label>
                </div>

                <div class="flex items-center justify-center mt-5">
                    <x-button class="btn btn-primary w-48">
                        {{ __('SUBMIT') }}
                    </x-button>
                </div>
            </form>
        </div>
        </br>
    </div>
</x-app-layout>
