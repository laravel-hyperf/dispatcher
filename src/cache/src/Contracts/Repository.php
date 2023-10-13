<?php

declare(strict_types=1);

namespace SwooleTW\Hyperf\Cache\Contracts;

use Closure;
use DateInterval;
use DateTimeInterface;
use Psr\SimpleCache\CacheInterface;

interface Repository extends CacheInterface
{
    /**
     * Retrieve an item from the cache and delete it.
     */
    public function pull(string $key, mixed $default = null): mixed;

    /**
     * Store an item in the cache.
     */
    public function put(string $key, mixed $value, null|DateInterval|DateTimeInterface|int $ttl = null): bool;

    /**
     * Store an item in the cache if the key does not exist.
     */
    public function add(string $key, mixed $value, null|DateInterval|DateTimeInterface|int $ttl = null): bool;

    /**
     * Increment the value of an item in the cache.
     */
    public function increment(string $key, int $value = 1): bool|int;

    /**
     * Decrement the value of an item in the cache.
     */
    public function decrement(string $key, int $value = 1): bool|int;

    /**
     * Store an item in the cache indefinitely.
     */
    public function forever(string $key, mixed $value): bool;

    /**
     * Get an item from the cache, or execute the given Closure and store the result.
     */
    public function remember(string $key, null|DateInterval|DateTimeInterface|int $ttl, Closure $callback): mixed;

    /**
     * Get an item from the cache, or execute the given Closure and store the result forever.
     */
    public function sear(string $key, Closure $callback): mixed;

    /**
     * Get an item from the cache, or execute the given Closure and store the result forever.
     */
    public function rememberForever(string $key, Closure $callback): mixed;

    /**
     * Remove an item from the cache.
     */
    public function forget(string $key): bool;

    /**
     * Get the cache store implementation.
     */
    public function getStore(): Store;
}
