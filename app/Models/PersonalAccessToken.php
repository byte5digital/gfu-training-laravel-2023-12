<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalAccessToken extends \Laravel\Sanctum\PersonalAccessToken
{
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function save(array $attributes = [], array $options = []): bool
    {
        if (null === $this->expires_at) {
            $this->expires_at = $this->determineExpry();
        }

        return parent::save($attributes, $options);
    }

    /**
     * @return $this
     */
    public function refreshExpiry(): self
    {
        $this->expires_at = $this->determineExpry();
        return $this;
    }

    /**
     * @return Carbon
     */
    private function determineExpry(): Carbon
    {
        return Carbon::now()->addSeconds(config('token.lifetime'));
    }


}
