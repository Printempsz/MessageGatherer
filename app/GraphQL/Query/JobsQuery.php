<?php

namespace App\GraphQL\Query;

use App\Models\Job;
use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class JobsQuery extends Query
{
    protected $attributes = [
        'name' => 'JobsQuery',
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('job'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id','type' => Type::int()],
            'name' => ['name' => 'name','type' => Type::string()],
            'description' => ['name' => 'description','type' => Type::string()],
            'requirement' => ['name' => 'requirement','type' => Type::string()],
            'location' => ['name' => 'location','type' => Type::string()],
            'salary' => ['name' => 'location','type' => Type::string()]
        ];
    }

//    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
//    {
////        $select = $fields->getSelect();
////        $with = $fields->getRelations();
////
////        return [];
//        if (isset($args['id'])) {
//            return Job::where('id' , $args['id'])->get();
//        }
//
//        return Job::all();
//    }
    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Job::where('id' , $args['id'])->get();
        }
        if (isset($args['name'])) {
            return Job::where('name' , $args['name'])->get();
        }
        if (isset($args['location'])) {
            return User::where('location' , $args['location'])->get();
        }

        return Job::all();
    }
}
