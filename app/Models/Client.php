<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Libraries\searchHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'condition_id',
        'city_id',
        'cuit',
        'business_name',
        'surname',
        'name',
        'address',
        'email',
        'phone',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function conditions()
    {
        return $this->belongsTo(Condition::class);
    }

    public static function getAllData($request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;
        if ($request->rowLimit) $limit = $request->rowLimit;

        $offset = $request->rowOffset;
        $searchValue = searchHelper::inputSearch($request->searchValue);
        $columnSortedBy = $request->columnSortedBy;
        $requestType = $request->reqType;

        $query = Client::query();

        if ($searchValue) {
            $query->where('business_name', 'LIKE', '%' . $searchValue . '%')
                ->orWhere('surname', 'LIKE', '%' . $searchValue . '%')
                ->orWhere('name', 'LIKE', '%' . $searchValue . '%');
        }

        if (empty($requestType)) {
            $count = $query->get()->count();

            $clients = $query->orderBy($columnName, 'DESC', $columnSortedBy)->take($limit)->skip($offset)->get();

            return ['data' => $clients, 'count' => $count];
        } else {
            $clients = $query->get();

            return $clients;
        }
    }
}
