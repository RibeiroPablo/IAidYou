<?php namespace App;

class Helpers
{
    /**
     * Remove all non-numeric values from a string
     *
     * @param string $value
     * @return string|string[]|null
     */
    public static function onlyNumbers(string $value)
    {
        return preg_replace('/[^0-9]/','', $value);
    }

    /**
     * Extract and returns an image and it's file extension from a base64 encoded image string
     *
     * @param string $imageBase64
     * @return array
     */
    public static function decodeBase64Image(string $imageBase64)
    {
        $imageBase64Array = explode(';base64', $imageBase64);
        $extension = (explode('image/', $imageBase64Array[0]))[1];
        $image = base64_decode($imageBase64Array[1]);

        return compact('image', 'extension');
    }
}
