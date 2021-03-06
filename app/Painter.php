<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;
use Storage;
use Hash;

class Painter extends Model implements Authenticatable, CanResetPassword
{
    use SoftDeletes, Notifiable;

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        //
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        //
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        //
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, 'painters'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'kana',
        'ceo_name',
        'type',
        'postal',
        'prefectures',
        'city',
        'address1',
        'address2',
        'tel',
        'fax',
        'charge_name1',
        'charge_name2',
        'charge_kana1',
        'charge_kana2',
        'charge_tel',
        'charge_email',
        'url',
        'established',
        'capital',
        'permission',
        'organization',
        'sales',
        'employees',
        'social_insurance',
        'accident_insurance',
        'other_insurance',
        'category',
        'image_file',
        'catch_copy',
        'constructions',
        'annual_constructions',
        'rank',
        'pr_copy',
        'message_key',
    ];

    /**
     * ???????????????????????????
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'message_key',
    ];

    /**
     * ?????????????????????????????????0
     *
     * @var array
     */
    protected $attributes = [
        'rank' => 0,
    ];

    /**
     * ????????????
     *
     * @return Example
     */
    public function examples()
    {
        return $this->hasMany('App\Example');
    }

    /**
     * ?????????
     *
     * @return Column
     */
    public function columns()
    {
        return $this->hasMany('App\Column');
    }

    /**
     * ??????
     *
     * @return Proposal
     */
    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }

    /**
     * ??????
     *
     * @return Contract
     */
    public function contracts()
    {
        return $this->hasMany('App\Contract');
    }

    /**
     * ??????
     *
     * @return Evaluation
     */
    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }

    /**
     * ?????????????????????
     *
     * @return Favorite
     */
    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    /**
     * ??????????????????
     *
     * @return Image
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /**
     * ????????????
     *
     * @return Attachment
     */
    public function attachments()
    {
        return $this->belongsToMany('App\Attachment');
    }

    /**
     * Attachments?????????????????????????????????????????????????????????
     */
    public function loadAttachments()
    {
        if (!$this->attachments) {
            $this->load('attachments');
        }

        return $this;
    }

    /**
     * ?????????????????????
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * ???????????????
     *
     * @return string
     */
    public function getPrefectureNameAttribute()
    {
        if (isset($this->prefectures)) {
            return config('const.select.prefecture')[$this->prefectures];
        }

        return '';
    }

    /**
     * ????????????????????????URL
     *
     * @return string
     */
    public function getProfileImageAttribute()
    {
        $value = $this->image_file;
        $storage = Storage::disk('profile_p');

        if ($storage->exists($value)) {
            return $storage->url($value);
        }

        return config('const.no_image');
    }

    /**
     * ????????????????????????????????????
     *
     * @return boolean
     */
    public function getProfileImageExistsAttribute()
    {
        $value = $this->image_file;
        $storage = Storage::disk('profile_p');

        return $storage->exists($value);
    }

    /**
     * ??????1URL
     *
     * @return string
     */
    public function getImageFile1Attribute()
    {
        $attachment = $this->loadAttachments()->attachments->where('index', 1)->first();

        if ($attachment) {
            return $attachment->url;
        }

        return null;
    }

    /**
     * ??????2URL
     *
     * @return string
     */
    public function getImageFile2Attribute()
    {
        $attachment = $this->loadAttachments()->attachments->where('index', 2)->first();

        if ($attachment) {
            return $attachment->url;
        }

        return null;
    }

    /**
     * ??????3URL
     *
     * @return string
     */
    public function getImageFile3Attribute()
    {
        $attachment = $this->loadAttachments()->attachments->where('index', 3)->first();

        if ($attachment) {
            return $attachment->url;
        }

        return null;
    }

    /**
     * ??????4URL
     *
     * @return string
     */
    public function getImageFile4Attribute()
    {
        $attachment = $this->loadAttachments()->attachments->where('index', 4)->first();

        if ($attachment) {
            return $attachment->url;
        }

        return null;
    }
}
