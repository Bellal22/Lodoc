<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Aboutapp;
use App\Http\Models\ContactUs;
use App\Http\Models\TermsConditions;
use App\Http\Models\SocialMedia;

class StaticContentController extends Controller
{
    //
    public function __construct()
    {
        $this->about_app = new Aboutapp();
        $this->contact_us = new ContactUs();
        $this->terms_conditions = new TermsConditions();
        $this->social_media = new SocialMedia();
    }

    public function GetAboutApp()
    {
        return $this->about_app->all();
    }

    public function getContactUs()
    {
        return $this->contact_us->all();
    }

    public function SocialMedia()
    {
        return $this->social_media->all();
    }

    public function GetTermsCondition()
    {
        return $this->terms_conditions->all();
    }
}
