<?php

namespace App\Repositories;

use App\Models\User;
use App\Validators\CustomValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UserRepository
{
    /**
     * @throws \Exception
     */
    public static function login(array $attributes): array
    {
        $attributes = (new CustomValidator($attributes, User::$loginRules))->getAttributes();

        /**
         * @var User $user
         */
        $user = static::findBy('email', $attributes['email']);

        if (password_verify($attributes['password'], $user->getAttribute('password'))) {
            $user->tokens()->delete();
            $token = $user->createToken('access_token')->plainTextToken;
            $success = true;
        } else {
            $token = null;
            $success = false;
        }
        return ['data' => ['token' => $token, 'success' => $success], Response::HTTP_OK];
    }

    /**
     * @throws \Exception
     */
    public static function register(array $attributes): array
    {
        $attributes = (new CustomValidator($attributes, User::$registerRules))->getAttributes();
        $user = new User();
        $user->setAttribute('name', $attributes['name']);
        $user->setAttribute('email', $attributes['email']);
        $user->setAttribute('password', password_hash($attributes['password'], PASSWORD_DEFAULT));
        $user->save();

        $user->token = $user->createToken('access_token')->plainTextToken;

        return ['data' => $user, 'status' => Response::HTTP_CREATED];
    }

    public static function findBy(string $key, string $value): Model
    {
        return User::query()->where($key, '=', $value)->first();
    }
}
