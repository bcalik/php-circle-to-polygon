<?php

/**
 * The GeoJSON spec does not support circles. If you wish to create an area that represents a circle,
 * your best bet is to create a polygon that roughly approximates the circle.
 * In the limit of the number of edges becoming infinite, your Polygon will match a circle.
 */
class CircleToPolygon
{
  /**
   * @param array $center          In [longitude, latitude] format
   * @param int $radius            In meters
   * @param int $numberOfSegments  Optional that defaults to 32
   */
  public static function convert($center, $radius, $numberOfSegments = 32)
  {
    $n = $numberOfSegments;
    $flatCoordinates = [];
    $coordinates = [];
    for ($i = 0; $i < $n; $i++) {
      $flatCoordinates = array_merge($flatCoordinates, static::offset($center, $radius, 2 * pi() * $i / $n));
    }
    $flatCoordinates[] = $flatCoordinates[0];
    $flatCoordinates[] = $flatCoordinates[1];

    for ($i = 0, $j = 0; $j < count($flatCoordinates); $j += 2) {
      $coordinates[$i++] = array_slice($flatCoordinates, $j, 2);
    }

    return [
      'type' => 'Polygon',
      'coordinates' => [array_reverse($coordinates)]
    ];
  }

  public static function toRadians($angleInDegrees = null)
  {
    return $angleInDegrees * pi() / 180;
  }

  public static function toDegrees($angleInRadians = null)
  {
    return $angleInRadians * 180 / pi();
  }

  public static function offset($c1, $distance, $bearing)
  {
    $lat1 = static::toRadians($c1[1]);
    $lon1 = static::toRadians($c1[0]);
    $dByR = $distance / 6378137; // distance divided by 6378137 (radius of the earth) wgs84
    $lat = asin(
      sin($lat1) * cos($dByR) +
      cos($lat1) * sin($dByR) * cos($bearing)
    );
    $lon = $lon1 + atan2(
      sin($bearing) * sin($dByR) * cos($lat1),
      cos($dByR) - sin($lat1) * sin($lat)
    );
    return [static::toDegrees($lon), static::toDegrees($lat)];
  }
}
