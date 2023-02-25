<?php

namespace App\Models;

use App\Libraries\searchHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'status_id',
        'vendor_id',
        'date',
        'discount',
        'subtotal',
        'total',
        'observation',
        'day',
        'hour'
    ];
    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public static function getAlldata($request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;
        if ($request->rowLimit) $limit = $request->rowLimit;

        $offset = $request->rowOffset;
        $searchValue = searchHelper::inputSearch($request->searchValue);
        $columnSortedBy = $request->columnSortedBy;
        $filtersData = $request->filtersData;
        $requestType = $request->reqType;

        if ($columnName == 'status_name') $columnName = 'orders.status_id';
        else if ($columnName == 'client_name') $columnName = 'orders.client_id';
        else $columnName = 'orders.id';

        $query = Order::query()
            ->leftJoin('clients', 'orders.client_id', '=', 'clients.id')
            ->leftJoin('statuses', 'orders.status_id', '=', 'statuses.id')
            ->groupBy('orders.id')
            ->select(
                'orders.*',
                'clients.business_name as client_name',
                'statuses.name as status_name',
            );

        if (!empty($filtersData)) {
            foreach ($filtersData as $singleFilter) {
                if (array_key_exists('key', $singleFilter) && $singleFilter['key'] == 'status') {
                    $query->where('orders.status_id', $singleFilter['value']);
                }
            }
        }

        if ($searchValue) {
            $query->where('clients.business_name', 'LIKE', '%' . $searchValue . '%');
        }

        if (empty($requestType)) {
            $count = $query->get()->count();

            $orders = $query->orderBy($columnName, 'DESC', $columnSortedBy)->take($limit)->skip($offset)->get();

            return ['data' => $orders, 'count' => $count];
        } else {
            $orders = $query->get();

            return $orders;
        }
    }
}
