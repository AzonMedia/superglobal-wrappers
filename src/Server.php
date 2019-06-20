<?php
declare(strict_types=1);

namespace Azonmedia\SuperglobalWrappers;
/**
 * Superglobal wrapper
 */
class Server implements \ArrayAccess
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $exception_message = NULL;

    public function __construct(array &$data, ?string $throw_exception_message = NULL)
    {
        $this->data = $data;
        $data = $this;
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     * @return mixed
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }
}