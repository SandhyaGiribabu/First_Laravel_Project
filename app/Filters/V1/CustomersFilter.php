<?php

namespace App\Filters\V1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter{

    protected $allowedParms=[
        'name' =>['eq'],
        'address' =>['eq'],
        'type' =>['eq'],
        'email' =>['eq'],
        'city' =>['eq'],
        'state' =>['eq'],
        'state' =>['eq'],
        'postalCode' => ['eq','gt','lt']
    ];

    protected $columnMap =[
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];
    
    
    
    
}