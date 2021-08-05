<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'Associated_Physician_Profile_ID_1',
        'Associated_Physician_Profile_ID_2',
        'Physician_Profile_Address_Line_1',
        'Physician_Profile_Address_Line_2',
        'Physician_Profile_Alternate_First_Name',
        'Physician_Profile_Alternate_Middle_Name',
        'Physician_Profile_Alternate_Last_Name',
        'Physician_Profile_Alternate_Suffix',
        'Physician_Profile_City',
        'Physician_Profile_Country_Name',
        'Physician_Profile_First_Name',
        'Physician_Profile_ID',
        'Physician_Profile_Last_Name',
        'Physician_Profile_License_State_Code_1',
        'Physician_Profile_License_State_Code_2',
        'Physician_Profile_License_State_Code_3',
        'Physician_Profile_License_State_Code_4',
        'Physician_Profile_License_State_Code_5',
        'Physician_Profile_Middle_Name',
        'Physician_Profile_OPS_Taxonomy_1',
        'Physician_Profile_OPS_Taxonomy_2',
        'Physician_Profile_OPS_Taxonomy_3',
        'Physician_Profile_OPS_Taxonomy_4',
        'Physician_Profile_OPS_Taxonomy_5',
        'Physician_Profile_Primary_Specialty',
        'Physician_Profile_Province_Name',
        'Physician_Profile_State',
        'Physician_Profile_Suffix',
        'Physician_Profile_Zipcode',
    ];

    public static function search(string $last = '', string $first = ''): string
    {
        try {
            return static::where('Physician_Profile_Last_Name', 'LIKE', $last)
                ->where('Physician_Profile_First_Name', 'LIKE', $first)
                ->limit(30000)  // TODO tune this for your site's performance
                ->get(
                    [
                        'Physician_Profile_First_Name',
                        'Physician_Profile_Last_Name',
                        'Physician_Profile_City',
                        'Physician_Profile_State',
                        'Physician_Profile_Zipcode',
                        'Physician_Profile_Primary_Specialty',
                    ]
                )->toJson();
        } catch (Exception $exception) {
            Log::warning(__METHOD__ . ':' .$exception);
            return '{}';
        }
    }
}
