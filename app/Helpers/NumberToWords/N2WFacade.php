<?php

namespace App\Helpers\NumberToWords;

use Illuminate\Support\Facades\Facade;
use InvalidArgumentException;

/**
 * @method static string toWords($number)
 * @method static string toCurrency($number, $unit = 'đồng')
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 *
 * @since 1.0.0
 */
class N2WFacade extends Facade
{
    /**
     * Từ điển hiện tại.
     *
     * @var null|DictionaryInterface
     */
    public static $dictionary;

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): Transformer
    {
        $dictionary = static::$dictionary ?? static::getDefaultDictionary();
        $dictionary = static::makeDictionary($dictionary);

        return app(Transformer::class, compact('dictionary'));
    }

    /**
     * Trả về từ điển mặc định trong config.
     */
    protected static function getDefaultDictionary(): string
    {
        return config('n2w.defaults.dictionary');
    }

    /**
     * Tạo từ điển.
     */
    protected static function makeDictionary(string $dictionary): DictionaryInterface
    {
        if (! $dictionaryClass = config("n2w.dictionaries.{$dictionary}")) {
            throw new InvalidArgumentException(sprintf('Dictionary (%s) is not defined!', $dictionary));
        }

        return app()->make($dictionaryClass);
    }
}
