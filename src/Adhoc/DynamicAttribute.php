<?php

namespace Genesis\Adhoc;

use Illuminate\Contracts\Support\Arrayable;
use UnexpectedValueException;

trait DynamicAttribute
{
    /**
     * Dynamic attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Set adhoc attributes.
     *
     * @param mixed $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if (!isset($this->attributes[$name])) {
            $this->attributes[$name] = '';
        }

        $this->attributes[$name] = $value;
    }

    /**
     * Get adhoc attributes.
     *
     * @param mixed $name
     *
     * @return mixed|string
     */
    public function __get($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        throw new UnexpectedValueException('Attribute '.$name.' is undefined');
    }

    /**
     * Convert attributes to array.
     *
     * @return array[]|\Illuminate\Contracts\Support\Arrayable[]
     */
    public function attributesToArray(): mixed
    {
        $returns = [];
        foreach ($this->attributes as $key => $value) {
            if ($value instanceof Arrayable) {
                $returns[$key] = $value->toArray();
            } else {
                $returns[$key] = $value;
            }
        }

        return $returns;
    }

    /**
     * Clear adhoc attributes.
     */
    public function clearAttributes(): void
    {
        $this->attributes = [];
    }

    /**
     * Populate adhoc attributes.
     *
     * @param array $attributes
     */
    public function populate(array $attributes): void
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }
}
