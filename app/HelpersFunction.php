<?php

use App\Models\Employee;
use Illuminate\Contracts\Auth\Authenticatable;

function isNavbarActive(string $url): string
{
    return Request()->is($url) ? 'active' : '';
}
function isNavbarTreeActive(string $url): string
{
    return Request()->is(app()->getLocale().'/'.$url) ? 'is-expanded' : '';
}
function isFullUrl(string $url): string
{
    return Request()->fullUrl() == url(app()->getLocale().'/'.$url) ? 'active' : '';
}
function getAuthByGuard(string $guard): Authenticatable
{
    return auth()->guard($guard)->user();
}
function getAuthUser(): Employee
{
    return auth()->guard()->user()->employee;
}
