<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Actions\Fortify\Request;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'DOB' => ['required', 'date'],
            'nationality' => ['required', 'string'],
            'race' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ])->validate();

        // Update user data
        $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);

        // Update profile data
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'DOB' => $input['DOB'],
                'nationality' => $input['nationality'],
                'race' => $input['race'],
                'gender' => $input['gender'],
                'address' => $input['address'],
                'phone' => $input['phone'],
            ]
        );

        // Optionally, add redirection logic in Jetstream
        session()->flash('status', 'Profile updated successfully!');
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
