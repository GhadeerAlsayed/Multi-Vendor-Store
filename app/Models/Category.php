<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name','parent_id','description','image','slug','status'
    ];

    public function scopeActive(Builder $builder){
        $builder->where('categories.status' ,'=','active');
    }

    public function scopeFilter(Builder $builder,$filters){
        $builder->when($filters['name'] ?? false,function ($builder,$value){
            $builder->where('categories.name','LIKE',"%{$value}%");
        });
        $builder->when($filters['status'] ?? false,function ($builder,$value){
            $builder->where('categories.status','=', $value);
        });
    }

    public static  function rules($id = 0){
        return[
                'name' => ["required",
                    "string",
                    "min:3",
                    "max:255",
                    Rule::unique('categories','name')->ignore($id),
//                    new Filter(['laravel','php','css','js']),
                'filter:php,html,laravel'
                ],

                'parent_id' => ['nullable','int','exists:categories,id'],
                'image'=> [
                    'image','max:1048576','dimensions:min_width=100,min_height=100',
                ],
                'status' => 'in:active,archived',

        ];
    }
}
