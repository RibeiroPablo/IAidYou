<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HelpRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

//  ██████╗ ███████╗██╗      █████╗ ████████╗██╗ ██████╗ ███╗   ██╗███████╗
//  ██╔══██╗██╔════╝██║     ██╔══██╗╚══██╔══╝██║██╔═══██╗████╗  ██║██╔════╝
//  ██████╔╝█████╗  ██║     ███████║   ██║   ██║██║   ██║██╔██╗ ██║███████╗
//  ██╔══██╗██╔══╝  ██║     ██╔══██║   ██║   ██║██║   ██║██║╚██╗██║╚════██║
//  ██║  ██║███████╗███████╗██║  ██║   ██║   ██║╚██████╔╝██║ ╚████║███████║
//  ╚═╝  ╚═╝╚══════╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚═╝ ╚═════╝ ╚═╝  ╚═══╝╚══════╝

    public function userRequest()
    {
        return $this->belongsTo(User::class, 'user_request_id');
    }

    public function userHelper()
    {
        return $this->belongsTo(User::class, 'user_helper_id');
    }

    public function category()
    {
        return $this->belongsTo(HelpCategory::class, 'category_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'help_request_id');
    }

    public function requestOffers()
    {
        return $this->hasMany(RequestOffer::class, 'help_request_id');
    }

//  ███████╗ ██████╗ ██████╗ ██████╗ ███████╗███████╗
//  ██╔════╝██╔════╝██╔═══██╗██╔══██╗██╔════╝██╔════╝
//  ███████╗██║     ██║   ██║██████╔╝█████╗  ███████╗
//  ╚════██║██║     ██║   ██║██╔═══╝ ██╔══╝  ╚════██║
//  ███████║╚██████╗╚██████╔╝██║     ███████╗███████║
//  ╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚══════╝╚══════╝

    /**
     * Search help requests requested by an user id
     *
     * @param $query
     * @param $user_request_id
     * @return mixed
     */
    public function scopeByUserRequest($query, $user_request_id)
    {
        return $query->where('user_request_id', $user_request_id);
    }

//  ███╗   ███╗███████╗████████╗██╗  ██╗ ██████╗ ██████╗ ███████╗
//  ████╗ ████║██╔════╝╚══██╔══╝██║  ██║██╔═══██╗██╔══██╗██╔════╝
//  ██╔████╔██║█████╗     ██║   ███████║██║   ██║██║  ██║███████╗
//  ██║╚██╔╝██║██╔══╝     ██║   ██╔══██║██║   ██║██║  ██║╚════██║
//  ██║ ╚═╝ ██║███████╗   ██║   ██║  ██║╚██████╔╝██████╔╝███████║
//  ╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝ ╚═════╝ ╚══════╝

    /**
     * Fill and save the request for help
     *
     * @param User $user
     * @param HelpCategory $category
     * @return bool
     */
    public function store(User $user, HelpCategory $category)
    {
        $this->fill([
            'latitude' => $user->address->latitude,
            'longitude' => $user->address->longitude,
        ]);

        $this->userRequest()->associate($user);
        $this->category()->associate($category);

        return $this->save();
    }
}
