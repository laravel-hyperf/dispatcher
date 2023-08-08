<?php

declare(strict_types=1);

namespace SwooleTW\Hyperf\JWT\Validations;

use Carbon\Carbon;
use SwooleTW\Hyperf\JWT\Exceptions\TokenInvalidException;
use SwooleTW\Hyperf\JWT\Validations\AbstractValidation;

class NotBeforeCliam extends AbstractValidation
{
    /**
     * @param  array  $payload
     * @return void
     */
    public function validate(array $payload): void
    {
        if (! $nbf = ($payload['nbf'] ?? null)) {
            return;
        }

        if ($this->timestamp($nbf)->subSecond($this->config['leeway'] ?? 0) > Carbon::now()) {
            throw new TokenInvalidException('Not Before (nbf) timestamp cannot be in the future');
        }
    }
}
