<?php

namespace App\Filters\V1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter{

    protected $allowedParms=[
        'customerId' =>['eq'],
        'amount' =>['eq','gt','lt','lte','gte'],
        'status' =>['eq','ne'],
        'billedDate' =>['eq','gt','lt','lte','gte'],
        'paidDate' =>['eq','gt','lt','lte','gte'],
    ];

    protected $columnMap =[
        'customerId' => 'customerId',
        'billedDate' => 'billedDate',
        'paidDate' => 'paidDate',

    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];
    
    public function transform(Request $request) {
        $eloQuery = [];
    
        foreach ($this->allowedParms as $param => $operators) {
            $query = $request->query($param);
    
            if (!isset($query)) {
                continue;
            }
    
            $column = $this->columnMap[$param] ?? $param;
    
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
    
        return $eloQuery;
    }
    
    
}