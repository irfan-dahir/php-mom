<?php

namespace MOM;

class Schema
{

    public static function create(?array $schema = null) : self
    {
        $instance = new self;

        if ($schema !== null) {
            $instance->add($schema);
        }

        return $instance;
    }

    public function add($props, $value = null) : self
    {
        if (is_array($props)) {
            $i = 0;
            foreach ($props as $prop => $val) {
                if ($prop === $i) {
                    $this->{$val} = $value;
                    continue;
                }

                $this->{$prop} = $val ?? $value;
            }
        }

        if (is_string($props)) {
            $this->{$props} = $value;
        }

        if (is_object($props)) {
            $props = get_object_vars($props);
            foreach ($props as $prop => $val) {
                $this->add($prop, $val);
            }
        }

        return $this;
    }

    public function remove($props) : self
    {
        if (is_array($props)) {
            foreach ($props as $prop) {
                unset($this->{$prop});
            }
        }

        if (is_string($props)) {
            unset($this->{$props});
        }

        return $this;
    }

    public function update($props, ?string $propNewName = null) : self
    {
        if (is_array($props)) {
            foreach ($props as $prop => $propNewName) {
                $this->{$propNewName} = $this->{$prop};
                $this->remove($prop);
            }
        }

        if (is_string($props)) {
            $this->{$propNewName} = $this->{$props}; // copy value
            $this->remove($props);
        }

        return $this;
    }

    public function toArray() : array
    {
        return (array) $this;
    }

    public function toJSON() : string
    {
        return \json_encode($this->toArray());
    }

    public static function fromJSON(string $json) : self
    {
        return self::create(
            \json_decode($json, true)
        );
    }
}