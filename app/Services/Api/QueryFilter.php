<?php


namespace App\Services\Api;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class QueryFilter
{
    /*
    * lt = little then
    * eq = equal
    * gt = greater then
    * lk = like
    */
    private const TEMPLATE = [
        'lt' => '<',
        'eq' => '=',
        'gt' => '>',
        'lk'=> 'like'
    ];

    public function filter(Model $model, Request $request): ?Builder
    {
        $requestData = $request->query();
        if(!empty($requestData)) {
            $query = $model::query();
            $template = self::TEMPLATE;
            $query->where(
                function (Builder $qb) use (&$requestData, &$template) {
                    foreach ($requestData as $field => $expression) {
                        foreach ($expression as $operator => $value) {
                            if ($operator == 'lk') {
                                $value = '%' . $value . '%';
                            }
                            $qb->where($field, $template[$operator], $value);
                        }
                    }
                }
            );
            return $query;
        } else {
            return null;
        }
    }
}
