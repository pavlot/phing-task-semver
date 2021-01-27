<?php

declare(strict_types=1);

use Phing\Support\BuildFileTest;

class SemverTaskTest extends BuildFileTest
{
    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }

    public function setUp(): void
    {
        $this->configureProject(__DIR__ . "/build.xml");
    }

    /**
     * @dataProvider versionIncreaseDataProvider
     */
    public function testVersionIncrease(string $action, string $value, string $expected): void
    {
        $this->getProject()->setProperty('increase_action', $action);
        $this->getProject()->setProperty('semver.set_value', $value);
        $this->executeTarget("increase_semver");
        $semver_version =$this->getProject()->getProperty('semver.version');

        $this->assertEquals($expected, $semver_version);
    }

    /**
     * @dataProvider versionIncreaseDataProvider
     */
    public function testVersionIncreaseFromProperty(string $action, string $value, string $expected): void
    {
        $this->getProject()->setProperty('increase_action', $action);
        $this->getProject()->setProperty('semver.set_value', $value);
        $this->executeTarget("increase_semver_from_property");
        $semver_version =$this->getProject()->getProperty('semver.version');

        $this->assertEquals($expected, $semver_version);
    }

    /**
     * @dataProvider versionIncreaseDataProvider
     */
    public function testVersionIncreaseFromPropertyStoreToDeafult(string $action, string $value, string $expected): void
    {
        $this->getProject()->setProperty('increase_action', $action);
        $this->getProject()->setProperty('semver.set_value', $value);
        $this->executeTarget("increase_semver_default_property");
        $semver_version =$this->getProject()->getProperty('semversion');

        $this->assertEquals($expected, $semver_version);
    }

    public function versionIncreaseDataProvider(): array
    {
        return [
            ["increase_major", "", "2.0.0"],
            ["increase_minor", "", "1.1.0"],
            ["increase_patch", "", "1.0.1"],

            ["set_major", "4", "4.0.0"],
            ["set_minor", "5", "1.5.0"],
            ["set_patch", "2", "1.0.2"],
            ["set_pre-release", "rc.1", "1.0.0-rc.1"],
            ["set_build", "245", "1.0.0+245"]
        ];
    }
}
