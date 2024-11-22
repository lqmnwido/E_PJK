<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>


<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">MANAGE USER</h1>
            <h4 class="text-2xl">Edit User</h4>
        </div>

        <div class="container mx-auto px-4">

            <form method="POST" action="{{ route('users.update', $user->userID) }}">
                {!! csrf_field() !!}
                @method('PATCH')

                <div>
                    <x-input id="name" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="Name"
                        type="text" name="name" value="{{ $user->name }}" required autofocus
                        autocomplete="name" />
                </div>

                <div class="mt-4 row">
                    <div class=" d-flex ">
                        <div class="flex-grow-1">
                            <x-input class="mt-1"
                                style="width:54%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
                                placeholder="IC Number" type="text" name="noIC" value="{{ $profile->noIC }}"
                                required autocomplete="ic" />
                            <x-input class="mt-1 ml-2"
                                style="width:45%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; "
                                placeholder="Date Of Birthday" type="date" name="DOB" value="{{ $profile->DOB }}"
                                required autocomplete="DOB" />
                        </div>
                    </div>
                </div>

                <div class="mt-4 row">
                    <div class="col-sm-12 d-flex">
                        <div class="flex-grow-1">
                            <select class="mt-1"
                                style="width:54%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
                                name="nationality">
                                @foreach (['Citizen', 'non-Citizen'] as $option)
                                    <option value="{{ $option }}"
                                        {{ old('nationality', $profile->nationality ?? '') === $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                            <select class="mt-1 ml-2"
                                style="width:45%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
                                name="race" required>
                                @foreach (['Malay', 'Chinese', 'Indian'] as $option)
                                    <option value="{{ $option }}"
                                        {{ old('race', $profile->race ?? '') === $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4 row">
                    <div class="col-sm-12 d-flex">
                        <div class="flex-grow-1">
                            <textarea style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" class="block mt-1 w-full"
                                placeholder="Address" rows="3" name="address">{{ old('address', $profile->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <x-label for="role" value="{{ __('Role') }}" class="mt-4" style="font-size:17px" />
                <select id="role" name="role"
                    class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach (['Admin', 'Citizen', 'Pengurus Jenazah'] as $option)
                        <option value="{{ $option }}"
                            {{ old('role', $user->role ?? '') === $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>

                <div class="mt-4">
                    <x-label for="Gender_:" value="{{ __('Gender :') }}" style="padding-bottom:10px; font-size:17px" />

                    <label style="padding-right:10px">
                        <input type="radio" name="gender" value="male" id="male"
                            {{ old('gender', $profile->gender ?? '') === 'male' ? 'checked' : '' }}> Male
                    </label>

                    <label>
                        <input type="radio" name="gender" value="female" id="female"
                            {{ old('gender', $profile->gender ?? '') === 'female' ? 'checked' : '' }}> Female
                    </label>
                </div>

                <div class="mt-4">
                    <x-input id="email" class="block mt-1 w-full"
                        style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" placeholder="Email"
                        type="email" name="email" value="{{ $user->email }}" required autocomplete="email" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '"
                                                                                                                                                                                                                                                                                                                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Terms
                                                                                                                                                                                                                                                                                                                                    of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '"
                                                                                                                                                                                                                                                                                                                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Privacy
                                                                                                                                                                                                                                                                                                                                    Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-center mt-4">

                    <x-button class="flex flex-col items-center mb-4 w-full">
                        {{ __('UPDATE') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
