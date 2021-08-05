<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * @param string $last
     * @param string $first
     * @return string json
     */
    public static function index(string $last='', string $first=''): string
    {
        // Sanitize, and add wildcard suffix
        $last = preg_replace('[^A-Za-z, -]', '', $last) . '%';
        $first = preg_replace('[^A-Za-z, -]', '', $first) . '%';

        return Doctor::search($last, $first);
    }
}
