<?php

/*
 * This file is part of Softerize Tablelize
 *
 * (c) Softerize Sistemas <oscar.dias@softerize.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Softerize\Tablelize;

/**
 * Original request data for more than one table lists - follows the singleton pattern
 *
 * @author Oscar Dias <oscar.dias@softerize.com>
 */
class TablelizeRequest
{
    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * @var Original request data
     */
    private $data = null;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }

    /**
     * Checks if the data has been set
     *
     * @return bool
     */
    public function isEmpty()
    {
        return ($this->data === null);
    }

    /**
     * Returns the request data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the request data
     *
     * @param  array $data
     * @return void
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }
}
