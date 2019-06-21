<?php
declare(strict_types=1);

namespace Azonmedia\SuperglobalWrappers;

class SuperglobalsBase implements \ArrayAccess
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

        $this->exception_message = $throw_exception_message;
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
        if (! \is_null($this->exception_message)) {
            throw new \Exception($this->exception_message);
        }

        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
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
        if (! \is_null($this->exception_message)) {
            throw new \Exception($this->exception_message);
        }

        return isset($this->data[$offset]);
    }
    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @throws Exception
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if (! \is_null($this->exception_message)) {
            throw new \Exception($this->exception_message);
        }

        return $this->data[$offset] ?? null;
    }
}
