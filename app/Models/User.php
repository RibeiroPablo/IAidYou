<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone_number',
        'type',
        'picture',
    ];

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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'picture_url',
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

//   █████╗  ██████╗ ██████╗███████╗███████╗███████╗ ██████╗ ██████╗ ███████╗
//  ██╔══██╗██╔════╝██╔════╝██╔════╝██╔════╝██╔════╝██╔═══██╗██╔══██╗██╔════╝
//  ███████║██║     ██║     █████╗  ███████╗███████╗██║   ██║██████╔╝███████╗
//  ██╔══██║██║     ██║     ██╔══╝  ╚════██║╚════██║██║   ██║██╔══██╗╚════██║
//  ██║  ██║╚██████╗╚██████╗███████╗███████║███████║╚██████╔╝██║  ██║███████║
//  ╚═╝  ╚═╝ ╚═════╝ ╚═════╝╚══════╝╚══════╝╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚══════╝

    /**
     * Get the picture URL
     *
     * @return string
     */
    public function getPictureUrlAttribute()
    {
        if(empty($this->picture)) {
            return null;
        }

        return asset('storage/' . $this->picture);
    }

//  ███╗   ███╗███████╗████████╗██╗  ██╗ ██████╗ ██████╗ ███████╗
//  ████╗ ████║██╔════╝╚══██╔══╝██║  ██║██╔═══██╗██╔══██╗██╔════╝
//  ██╔████╔██║█████╗     ██║   ███████║██║   ██║██║  ██║███████╗
//  ██║╚██╔╝██║██╔══╝     ██║   ██╔══██║██║   ██║██║  ██║╚════██║
//  ██║ ╚═╝ ██║███████╗   ██║   ██║  ██║╚██████╔╝██████╔╝███████║
//  ╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝ ╚═════╝ ╚══════╝

    /**
     * Receive a base64 encodede image and save it into the storage/app/public folder
     *
     * @param string $imageBase64
     * @return string
     */
    public function storePicture(string $imageBase64)
    {
        $picture = Helpers::decodeBase64Image($imageBase64);
        $filename = uniqid() . '.' . $picture['extension'];
        Storage::disk('public')->put($filename, $picture['image'], 'public');

        return $filename;
    }

    /**
     * Fill and save the user and it's address
     *
     * @param Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        $this->fill([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'picture' => $this->storePicture($request->picture),
        ]);

        $address = new Address;
        $address->store($request);

        $this->address()->associate($address);

        return $this->save();
    }
}
