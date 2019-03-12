<?php

namespace App\GraphQL\Type;

use App\Models\Job;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class JobType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Job',
        'description' => '工作',
        'model' => Job::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => '工作id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '工作名'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => '工作职责描述'
            ],
            'requirement' => [
                'type' => Type::string(),
                'description' => '工作需求'
            ],
            'location' => [
                'type' => Type::string(),
                'description' => '工作地点'
            ],
            'salary' => [
                'type' => Type::string(),
                'description' => '工资'
            ]
        ];
    }
}
