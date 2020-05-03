<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

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

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function helpRequestsAsked()
    {
        return $this->hasMany(HelpRequest::class, 'user_request_id');
    }

    public function helpRequestsGiven()
    {
        return $this->hasMany(HelpRequest::class, 'user_helper_id');
    }

    public function requestOffersMade()
    {
        return $this->hasMany(RequestOffer::class, 'help_request_id');
    }

    public function ratingsReceived()
    {
        return $this->hasMany(Rating::class, 'user_helper_id');
    }

//  ███████╗ ██████╗ ██████╗ ██████╗ ███████╗███████╗
//  ██╔════╝██╔════╝██╔═══██╗██╔══██╗██╔════╝██╔════╝
//  ███████╗██║     ██║   ██║██████╔╝█████╗  ███████╗
//  ╚════██║██║     ██║   ██║██╔═══╝ ██╔══╝  ╚════██║
//  ███████║╚██████╗╚██████╔╝██║     ███████╗███████║
//  ╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚══════╝╚══════╝

    /**
     * Search an user by phone number
     *
     * @param $query
     * @param $number
     * @return mixed
     */
    public function scopeByPhoneNumber($query, $number)
    {
        return $query->where('phone_number', Helpers::onlyNumbers($number));
    }

//  ███╗   ███╗██╗   ██╗████████╗ █████╗ ████████╗ ██████╗ ██████╗ ███████╗
//  ████╗ ████║██║   ██║╚══██╔══╝██╔══██╗╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
//  ██╔████╔██║██║   ██║   ██║   ███████║   ██║   ██║   ██║██████╔╝███████╗
//  ██║╚██╔╝██║██║   ██║   ██║   ██╔══██║   ██║   ██║   ██║██╔══██╗╚════██║
//  ██║ ╚═╝ ██║╚██████╔╝   ██║   ██║  ██║   ██║   ╚██████╔╝██║  ██║███████║
//  ╚═╝     ╚═╝ ╚═════╝    ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝

    /**
     * Set the user's phone number to only numbers
     *
     * @param string $value
     * @return void
     */
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = Helpers::onlyNumbers($value);
    }

}
