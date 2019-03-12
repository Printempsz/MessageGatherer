<?php

namespace App\GraphQL\Mutation;

use App\Models\Job;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class CreateJobMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateJobMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('job');
    }

    public function args()
    {
        return [
            'userId' => [
                'name' => 'userId',
                'type' => Type::id()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::nonNull(Type::string())
            ],
            'requirement' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'picture' => [
                'name' => 'salary',
                'type' => Type::string()
    ]
        ];
    }

    public function resolve($root, $args)
    {
        $job = Job::created($args);
        if(!$job) {
            return null;
        }
        return $job;
    }
}
