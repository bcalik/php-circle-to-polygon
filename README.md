# Circle To Polygon

This code is a PHP implementation of [arg20/circle-to-radius](https://github.com/arg20/circle-to-radius) npm package.

The GeoJSON spec does not support circles. If you wish to create an area that represents a circle, your best bet is to create a polygon that roughly approximates the circle. In the limit of the number of edges becoming infinite, your Polygon will match a circle.

## Usage

```php
<?php
$coordinates = [29.2112644, 40.912318]; // [lon, lat]
$radius = 50;                           // in meters
$numberOfEdges = 16;                    // optional that defaults to 32

$result = \CircleToPolygon::convert($coordinates, $radius, $numberOfEdges);

var_dump($result);

/*
array:2 [
  "type" => "Polygon"
  "coordinates" => array:1 [
    0 => array:17 [
      0 => array:2 [
        0 => 29.2112644
        1 => 40.912767157642
      ]
      1 => array:2 [
        0 => 29.211036950773
        1 => 40.912732967329
      ]
      2 => array:2 [
        0 => 29.210844129248
        1 => 40.912635601652
      ]
      3 => array:2 [
        0 => 29.21071529101
        1 => 40.912489883886
      ]
      4 => array:2 [
        0 => 29.210670050258
        1 => 40.912317998474
      ]
      5 => array:2 [
        0 => 29.210715293866
        1 => 40.91214611351
      ]
      6 => array:2 [
        0 => 29.210844133286
        1 => 40.912000396823
      ]
      7 => array:2 [
        0 => 29.211036953628
        1 => 40.911903032224
      ]
      8 => array:2 [
        0 => 29.2112644
        1 => 40.911868842358
      ]
      9 => array:2 [
        0 => 29.211491846372
        1 => 40.911903032224
      ]
      10 => array:2 [
        0 => 29.211684666714
        1 => 40.912000396823
      ]
      11 => array:2 [
        0 => 29.211813506134
        1 => 40.91214611351
      ]
      12 => array:2 [
        0 => 29.211858749742
        1 => 40.912317998474
      ]
      13 => array:2 [
        0 => 29.21181350899
        1 => 40.912489883886
      ]
      14 => array:2 [
        0 => 29.211684670752
        1 => 40.912635601652
      ]
      15 => array:2 [
        0 => 29.211491849227
        1 => 40.912732967329
      ]
      16 => array:2 [
        0 => 29.2112644
        1 => 40.912767157642
      ]
    ]
  ]
]
*/
```
