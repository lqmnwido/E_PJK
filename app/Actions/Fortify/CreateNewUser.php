<?php
namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return \App\Models\User
     */
    public function create(array $input): User
    {
        // Validate User Data
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $userID = 'U' . rand(1111, 9999);

        // Create User
        $user = User::create([
            'userID' => $userID,
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => $input['role'],
            'password' => Hash::make($input['password']),
        ]);

        // Validate Profile Data
        Validator::make($input, [
            'noIC' => ['required', 'string', 'max:255'],
            'DOB' => ['required', 'date'],
            'nationality' => ['required', 'string', 'max:255'],
            'race' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ])->validate();

        $profileID = 'P' . rand(1111, 9999);

        // Create Profile
        Profile::create([
            'profileID' => $profileID,
            'userID' => $userID,
            'noIC' => $input['noIC'],
            'DOB' => $input['DOB'],
            'nationality' => $input['nationality'],
            'race' => $input['race'],
            'gender' => $input['gender'],
            'address' => $input['address'],
        ]);

        // Return only the User instance
        return $user;
    }
}
