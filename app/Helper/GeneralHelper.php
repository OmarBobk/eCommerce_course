<?php

use Illuminate\Support\Facades\Cache;

function getParentShowOf($param) {
    $route = str_replace('admin.', '', $param);

    $per = Cache::get('admin_side_menu')
        ->where('as', $route)
        ->first();
    return $per ? $per->parent_show : $route;
}

function getParentOf($param) {
    $route = str_replace("admin.", "", $param);
    $per   = Cache::get('admin_side_menu')
        ->where('as', $route)
        ->first();

    return $per ? $per->parent : $route;
}

function getParentIdOf($param) {
    $route = str_replace("admin.", "", $param);
    $per   = Cache::get('admin_side_menu')
        ->where('as', $route)
        ->first();

    return $per ? $per->id : null;
}
