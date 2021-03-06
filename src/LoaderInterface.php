<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2016 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose;

use Jose\Object\JWKInterface;
use Jose\Object\JWKSetInterface;
use Psr\Log\LoggerInterface;

/**
 * Loader Interface.
 */
interface LoaderInterface
{
    /**
     * Load data and try to return a JWSInterface object, a JWEInterface object or a list of these objects.
     * If the result is a JWE (list), nothing is decrypted and method `decrypt` must be executed
     * If the result is a JWS (list), no signature is verified and method `verifySignature` must be executed.
     *
     * @param string $input A string that represents a JSON Web Token message
     *
     * @return \Jose\Object\JWSInterface|\Jose\Object\JWEInterface If the data has been loaded.
     */
    public function load($input);

    /**
     * @param string                        $input
     * @param \Jose\Object\JWKInterface     $jwk
     * @param string[]                      $allowed_key_encryption_algorithms
     * @param string[]                      $allowed_content_encryption_algorithms
     * @param null|int                      $recipient_index
     * @param \Psr\Log\LoggerInterface|null $logger
     *
     * @return \Jose\Object\JWSInterface|\Jose\Object\JWEInterface If the data has been loaded.
     */
    public function loadAndDecryptUsingKey($input, JWKInterface $jwk, array $allowed_key_encryption_algorithms, array $allowed_content_encryption_algorithms, &$recipient_index = null, LoggerInterface $logger = null);

    /**
     * @param string                        $input
     * @param \Jose\Object\JWKSetInterface  $jwk_set
     * @param string[]                      $allowed_key_encryption_algorithms
     * @param string[]                      $allowed_content_encryption_algorithms
     * @param null|int                      $recipient_index
     * @param \Psr\Log\LoggerInterface|null $logger
     *
     * @return \Jose\Object\JWEInterface If the data has been loaded.
     */
    public function loadAndDecryptUsingKeySet($input, JWKSetInterface $jwk_set, array $allowed_key_encryption_algorithms, array $allowed_content_encryption_algorithms, &$recipient_index = null, LoggerInterface $logger = null);

    /**
     * @param string                        $input
     * @param \Jose\Object\JWKInterface     $jwk
     * @param string[]                      $allowed_algorithms
     * @param null|int                      $signature_index
     * @param \Psr\Log\LoggerInterface|null $logger
     *
     * @return \Jose\Object\JWSInterface If the data has been loaded.
     */
    public function loadAndVerifySignatureUsingKey($input, JWKInterface $jwk, array $allowed_algorithms, &$signature_index = null, LoggerInterface $logger = null);

    /**
     * @param string                        $input
     * @param \Jose\Object\JWKSetInterface  $jwk_set
     * @param string[]                      $allowed_algorithms
     * @param null|int                      $signature_index
     * @param \Psr\Log\LoggerInterface|null $logger
     *
     * @return \Jose\Object\JWSInterface If the data has been loaded.
     */
    public function loadAndVerifySignatureUsingKeySet($input, JWKSetInterface $jwk_set, array $allowed_algorithms, &$signature_index = null, LoggerInterface $logger = null);

    /**
     * @param string                        $input
     * @param \Jose\Object\JWKInterface     $jwk
     * @param string[]                      $allowed_algorithms
     * @param string                        $detached_payload
     * @param null|int                      $signature_index
     * @param \Psr\Log\LoggerInterface|null $logger
     *
     * @return \Jose\Object\JWSInterface If the data has been loaded.
     */
    public function loadAndVerifySignatureUsingKeyAndDetachedPayload($input, JWKInterface $jwk, array $allowed_algorithms, $detached_payload, &$signature_index = null, LoggerInterface $logger = null);

    /**
     * @param string                        $input
     * @param \Jose\Object\JWKSetInterface  $jwk_set
     * @param string[]                      $allowed_algorithms
     * @param string                        $detached_payload
     * @param null|int                      $signature_index
     * @param \Psr\Log\LoggerInterface|null $logger
     *
     * @return \Jose\Object\JWSInterface If the data has been loaded.
     */
    public function loadAndVerifySignatureUsingKeySetAndDetachedPayload($input, JWKSetInterface $jwk_set, array $allowed_algorithms, $detached_payload, &$signature_index = null, LoggerInterface $logger = null);
}
