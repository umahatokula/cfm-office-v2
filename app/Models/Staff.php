<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Staff extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;

	protected $appends = ['name'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['fname', 'lname'])
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get name attribute
     *
     * @return bool
     */
    public function getNameAttribute()
    {
        $lname = isset($this->attributes['lname']) ? $this->attributes['lname'] : '';
        $fname = isset($this->attributes['fname']) ? $this->attributes['fname'] : '';
        
        return $lname .' '.$fname;
    }
    
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = trim(str_replace(' ', '', $value));
    }

    /**
     * Ensure phone number has country code.
     *
     * @return bool
     */
    public function getPhoneAttribute($value)
    {
        $phone = $value;

        if (strlen($value) == 11) {
           $phone = '+234'.substr($value, 1);
        }

        if (strlen($value) == 10) {
           $phone = '+234'.$value;
        }

        return $phone;
    }

    public function bankDetails() {
        return $this->hasMany(StaffBankDetail::class, 'staff_id', 'id');
    }

    public function primaryBankDetails() {
        return $this->hasMany(StaffBankDetail::class, 'staff_id', 'id')->where('is_primary');
    }
    
	public function church(){
		return $this->belongsTo(Church::class)->withDefault();
	}

	public function gender(){
		return $this->belongsTo(Gender::class)->withDefault();
	}

	public function country(){
		return $this->belongsTo(Country::class)->withDefault();
	}

	public function state(){
		return $this->belongsTo(State::class)->withDefault();
	}

	public function local(){
		return $this->belongsTo(Local::class)->withDefault();
	}
}
