<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Communicates with users micro service
 */
class UserService
{
    /**
     * Makes a request to the users service and returns response
     * @return \Illuminate\Http\Client\Response
     */
    public function make_request(string $method, string $url)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.users.token')
        ])->send($method, config('services.users.base_url') . '/' . $url);
    }

    /**
     * Gets user by email from user service
     * @return object
     */
    public function get_user(string $email)
    {
        return json_decode($this->make_request('get', 'users/by_email/'.$email)->body());
    }
}
