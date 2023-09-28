<?php

namespace App\Helpers;

use App\Dictionaries\AppDomain;
use Illuminate\Support\Str;

class DataHelper
{
    public static function getListDomainByApp($domain_id = AppDomain::FINDER)
    {
        $arrDomain = AppDomain::all();
        switch ($domain_id) {
            case AppDomain::FINDER:
                $arrDomain = AppDomain::finderDomain();
                break;
            case AppDomain::SPACE_GOLF:
                $arrDomain = AppDomain::spacegolfDomain();
                break;
            case AppDomain::FRUIT_STORE:
                $arrDomain = AppDomain::fruitDomain();
                break;
            case AppDomain::HOME_HTP:
                $arrDomain = AppDomain::htpDomain();
                break;
            case AppDomain::HOME_PAY:
                $arrDomain = AppDomain::htpDomain();
                break;
            case AppDomain::BLOG:
                $arrDomain = AppDomain::all();
                break;
            default:
                $arrDomain = AppDomain::all();
                break;
        }

        return $arrDomain;
    }

    /**
     * Camel case to underscore string input
     *
     * @return string
     */
    public static function decamelize($string)
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }

    public static function convertImgPathToSlug(string $image_path)
    {
        //Covnert string to slug
        $slug = Str::slug($image_path);
    }
}
