<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'address_2',
        'city',
        'postal_code',
        'province',
        'country',
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

    public function user()
    {
        return $this->hasOne(User::class, 'address_id');
    }

//  ███╗   ███╗███████╗████████╗██╗  ██╗ ██████╗ ██████╗ ███████╗
//  ████╗ ████║██╔════╝╚══██╔══╝██║  ██║██╔═══██╗██╔══██╗██╔════╝
//  ██╔████╔██║█████╗     ██║   ███████║██║   ██║██║  ██║███████╗
//  ██║╚██╔╝██║██╔══╝     ██║   ██╔══██║██║   ██║██║  ██║╚════██║
//  ██║ ╚═╝ ██║███████╗   ██║   ██║  ██║╚██████╔╝██████╔╝███████║
//  ╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝ ╚═════╝ ╚══════╝

    /**
     * Fill and save the address
     *
     * @param Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        //TODO Remove these default values added temporary. For now the app only has a simple input to add the full address
        $this->fill([
            'address' => $request->address,
            'address_2' => $request->input('address_2', null),
            'city' => $request->input('city', 'Toronto'),
            'postal_code' => $request->input('postal_code', 'A1B 2C3'),
            'province' => $request->input('province', 'Ontario'),
            'country' => $request->input('country', 'Canada'),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return $this->save();
    }
}
