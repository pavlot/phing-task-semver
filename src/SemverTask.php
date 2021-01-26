<?php

namespace Phing\Tasks\Ext;

use Phing\Task;
use Phing\Exception\BuildException;

use Rollerworks\Component\Version\Version;

class SemverTask extends Task
{

    private $action = null;
    private $input = null;
    private $output = null;

    public function setAction($str)
    {
        $this->action = $str;
    }
    public function setInput($str)
    {
        $this->input = $str;
    }

    public function setOutput($str)
    {
        $this->output = $str;
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
        $version = Version::fromString($this->input);
        $result = $this->executeAction($this->action, $version);
        $this->getProject()->setNewProperty($this->output, $result->full);
    }


    private function executeAction($action, $version)
    {
        $result = null;
        switch ($action) {
            case 'increase_major':
                $result = $version->getNextIncreaseOf('major');
                break;
            case 'increase_minor':
                $result = $version->getNextIncreaseOf('minor');
                break;
            case 'increase_next':
                $result = $version->getNextIncreaseOf('next');
                break;
            case 'increase_patch':
                $result = $version->getNextIncreaseOf('patch');
                break;
            case 'increase_stable':
                $result = $version->getNextIncreaseOf('stable');
                break;
            case 'increase_alpha':
                $result = $version->getNextIncreaseOf('alpha');
                break;
            case 'increase_beta':
                $result = $version->getNextIncreaseOf('beta');
                break;
            case 'increase_rc':
                $result = $version->getNextIncreaseOf('rc');
                break;
            default:
                throw new BuildException("Unknow action given:".$action);
                break;
        }
        return $result;
    }
}
