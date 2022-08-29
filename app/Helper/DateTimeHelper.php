<?php

namespace App\Helper;

/**
 * Description of DateHelper
 */
class DateTimeHelper {

    /**
     * @var \Datetime
     */
    protected $instance;

    public function setInstance()
    {
        if ($this->instance === null)
        {
            $this->instance = new \DateTime();
        }
        return $this;
    }

    public function getModifiedDate(string $modifiers)
    {
        $this->setInstance();
        $this->instance->modify($modifiers);
        $retVal = $this->instance->format('Y-m-d');

        $this->clearInstance();

        return $retVal;
    }

    public function clearInstance()
    {
        $this->instance = null;
        return $this;
    }

}
