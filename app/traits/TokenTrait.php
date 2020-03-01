<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 2/29/20
 * Time: 3:25 PM
 */

namespace App\traits;


use Illuminate\Support\Str;

trait TokenTrait
{
    public $api_token;
    /**
     * @param $user -> authenticated User
     */
    public function generateToken($user){
        $token = Str::random(60);
        $this->api_token =  $token;
        $user->forceFill([
            'api_token' => $this->api_token,
        ])->save();
    }

}
