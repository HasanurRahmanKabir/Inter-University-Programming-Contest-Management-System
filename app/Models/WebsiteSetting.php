<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_name',
        'header_logo',
        'footer_logo',
        'hero_banner',
        'hero_title',
        'hero_description',
        'about_image',
        'about_title',
        'about_description',
        'event_schedule_title_1',
        'event_schedule_description_1',
        'event_schedule_title_2',
        'event_schedule_description_2',
        'prize_pool_amount',
        'footer_description',
        'location',
        'email',
        'phone_number',
        'facebook_link',
        'youtube_link',
        'linkedin_link',
        'platform_1_name',
        'platform_1_link',
        'platform_2_name',
        'platform_2_link',
        'platform_3_name',
        'platform_3_link',
        'platform_4_name',
        'platform_4_link',
        'copyright_text',
    ];
}