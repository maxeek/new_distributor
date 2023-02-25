<?php

namespace App\Models;

use App\Libraries\searchHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'barcode',
        'sku',
        'title',
        'detail',
        'price',
        'sale_price',
        'stock',
        'alert',
        'img',
        'variation',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getAllData($request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;
        if ($request->rowLimit) $limit = $request->rowLimit;

        $offset = $request->rowOffset;
        $searchValue = searchHelper::inputSearch($request->searchValue);
        $columnSortedBy = $request->columnSortedBy;
        $filtersData = $request->filtersData;
        $requestType = $request->reqType;

        if ($columnName == 'category_name') $columnName = 'products.category_id';
        else if ($columnName == 'title') $columnName = 'produdcts.title';
        else if ($columnName == 'order') $columnName = 'produdcts.order';
        else $columnName = 'products.id';

        $query = Product::query()->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('products.id')
            ->select(
                'products.*',
                'categories.name as category_name'
            );

        if (!empty($filtersData)) {
            foreach ($filtersData as $singleFilter) {
                if (array_key_exists('key', $singleFilter) && $singleFilter['key'] == 'category') {
                    $query->where('products.category_id', $singleFilter['value']);
                }
            }
        }

        if ($searchValue) {
            $query->where('products.title', 'LIKE', '%' . $searchValue . '%')
                ->orWhere('categories.name', 'LIKE', '%' . $searchValue . '%');
        }

        if (empty($requestType)) {
            $count = $query->get()->count();

            $products = $query->orderBy($columnName, $columnSortedBy)->take($limit)->skip($offset)->get();

            return ['data' => $products, 'count' => $count];
        } else {
            $products = $query->get();

            return $products;
        }
    }

    public static function getPosData($request)
    {
        $query = Product::query()
            ->groupBy('products.id')
            ->select('products.*');
            // ->where('products.stock', '>', 0);

        if ($request->category_id != null && $request->search == null) {
            $query->where('products.category_id', $request->category_id);
        }

        if ($request->subcategory_id != null  && $request->search == null) {
            $query->where('products.subcategory_id', $request->subcategory_id);
        }

        if ($request->search) {
            $query->where('products.title', 'LIKE', '%' . $request->search . '%');
            // ->orWhere('products.barcode', 'LIKE', '%' . $request->search . '%');
        }

        return $query->orderBy('order', 'ASC')->get();
    }
}
