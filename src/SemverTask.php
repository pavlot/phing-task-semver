<?php

namespace Phing\Tasks\Ext;

use Phing\Task;
use Phing\Exception\BuildException;

use PHLAK\SemVer;

class SemverTask extends Task
{

    private $action = null;
    private $version = null;
    private $version_value = null;
    private $property = "semversion";

    public function setAction($str)
    {
        $this->action = $str;
    }
    public function setVersion($str)
    {
        $this->version = new SemVer\Version($str);
    }

    public function setVersionValue($str)
    {
        $this->version_value = $str;
    }

    public function setProperty($str)
    {
        $this->property = $str;
    }

    /**
     * The init method: Do init steps.
     */
    public function init()
    {
        // nothing to do here
    }

    /**
     * The main entry point method.
     */
    public function main()
    {
        $result = $this->executeAction($this->action, $this->version_value);
        $this->getProject()->setNewProperty($this->property, (string)$this->version);
    }

    private function executeAction($action, $value)
    {
        $result = null;
        switch ($action) {
            case 'increase_major':
                $result = $this->version->incrementMajor();
                break;
            case 'increase_minor':
                $result = $this->version->incrementMinor();
                break;
            case 'increase_patch':
                $result = $this->version->incrementPatch();
                break;
            case 'set_major':
                $result = $this->version->setMajor($value);
                break;
            case 'set_minor':
                $result = $this->version->setMinor($value);
                break;
            case 'set_patch':
                $result = $this->version->setPatch($value);
                break;
            case 'set_pre-release':
                $result = $this->version->setPreRelease($value);
                break;
            case 'set_build':
                $result = $this->version->setBuild($value);
                break;

            default:
                throw new BuildException("Unknow action given:" . $action);
                break;
        }
        return $result;
    }
}
