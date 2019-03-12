<?php

namespace App\GraphQL\Mutation;

use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;


class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateUser'
    ];

    public function type()
    {
        return GraphQL::type('user');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = new User;
        $user->name = $args['name']??'zhl';
        $user->email = $args['exmail']??'zzz';
        $user->password = bcrypt($args['password']??'1234');
        $user->save();
        if(!$user) return null;
        return $user;
    }
}
