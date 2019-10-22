<?php

/**
 * Calculates the great-circle distance between two points on a sphere.
 *
 * Usage example, determining the distance from Land's End to John O'Groats:
 *
 * Haversine::make([50.0657, 5.7132], [58.6373, 3.0689])->meters(); // 968205.89737109
 * Haversine::make([50.0657, 5.7132], [58.6373, 3.0689])->kilometers(); // 968.20589737109
 * Haversine::make([50.0657, 5.7132], [58.6373, 3.0689])->miles(); // 601.61525278069
 */
class Haversine
{
    /** @var array */
    public $from;

    /** @var array */
    public $to;

    /**
     * The radius of the sphere in meters.
     * Default is 6371000 meters: the radius of the Earth.
     *
     * @var int
     */
    protected $radius = 6371000;

    public function __construct(array $from, array $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public static function make(array $from, array $to)
    {
        return new static($from, $to);
    }

    /**
     * Get the radian value of the from latitude
     *
     * @return float
     */
    public function latFrom()
    {
        $from = array_values($this->from);

        return deg2rad(reset($from));
    }

    /**
     * Get the radian value of the from longitude
     *
     * @return float
     */
    public function longFrom()
    {
        $from = array_reverse(array_values($this->from));

        return deg2rad(reset($from));
    }

    /**
     * Get the radian value of the to latitude
     *
     * @return float
     */
    public function latTo()
    {
        $to = array_values($this->to);

        return deg2rad(reset($to));
    }

    /**
     * Get the radian value of the to longitude
     *
     * @return float
     */
    public function longTo()
    {
        $to = array_reverse(array_values($this->to));

        return deg2rad(reset($to));
    }

    /**
     * Calculates the central angle between the two points
     *
     * @see https://en.wikipedia.org/wiki/Central_angle
     * @return float|int
     */
    public function angle()
    {
        $latDelta = $this->latTo() - $this->latFrom();
        $longDelta = $this->longTo() - $this->longFrom();

        return 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($this->latFrom()) * cos($this->latTo()) * pow(sin($longDelta / 2), 2)));
    }

    /**
     * Get the distance in meters
     *
     * @return float|int
     */
    public function meters()
    {
        return $this->angle() * $this->radius;
    }

    /**
     * Get the distance in kilometers
     *
     * @return float|int
     */
    public function kilometers()
    {
        return $this->meters() / 1000;
    }

    /**
     * Get the distance in miles.
     * 1609.344 is how many meters in a mile.
     *
     * @return float|int
     */
    public function miles()
    {
        return $this->meters() / 1609.344;
    }
}
