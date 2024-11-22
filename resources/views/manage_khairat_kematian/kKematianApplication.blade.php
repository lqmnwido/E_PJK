<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>


<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">MANAGE KHAIRAT KEMATIAN</h1>
        </div>

        <div class="container mx-auto px-4" style="background-color: rgb(182, 179, 179); border-radius: 25px;">

            <form method="POST" action="{{route('kKematian.store')}}">
                @csrf
            </br>
                <h3 class="font-bold">BORANG KEAHLIAN</h3>
                <div>
                    <x-input id="name" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="no.IC"
                        type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="No. Kad Pengenalan" />
                </div>
            </br>
                <div>
                    <x-input id="name" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="no.IC"
                        type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="Nama" />
                </div>
            </br>
                <div>
                    <x-input id="name" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="no.IC"
                        type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="No. Telefon" />
                </div>
            </br>
                <div>
                    <x-input id="name" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="no.IC"
                        type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="Tarikh Lahir" />
                </div>
            </br>
                <div>
                    <x-input id="name" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="no.IC"
                        type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="Nama Waris" />
                </div>
            </br>
                <div>
                    <x-input id="name" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="no.IC"
                        type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="No. Kad Pengenalan" />
                </div>

            </br>
            <h3 class="font-bold">YURAN AHLI</h3>
            <h5 class="font-bold">RM50.00 (SETAHUN)</h5>

                <div class="flex items-center justify-center mt-4">

                    <x-button class="flex flex-col items-center mb-4 w-full">
                        {{ __('SUBMIT') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
