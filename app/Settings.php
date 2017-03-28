<?php

namespace App;

class Settings {
    protected $user;

    protected $settings = [];

    public function __construct(array $settings, User $user)
    {
        $this->user = $user;
        $this->settings = $settings;
    }

    public function get($key)
    {
        return array_get($this->settings, $key);
    }

    public function set($key, $value)
    {
        $this->settings[$key] = $value;

        $this->persist();
    }

    public function has($key)
    {
        return array_key_exists($key, $this->settings);
    }

    public function all()
    {
        return $this->settings;
    }

    public function merge(array $attributes)
    {
        $this->settings = array_merge(
            $this->settings,
            array_only($attributes, array_keys($this->settings))
        );

        return $this->persist();
    }

    protected function persist()
    {
        return $this->user->update(['settings' => $this->settings]);
    }

    public function __get($key)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        throw new Exception("The {$key} settings does not exist.", 1);

    }
}
