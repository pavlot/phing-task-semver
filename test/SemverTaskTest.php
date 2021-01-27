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
    public function testVersionIncrease(string $action, string $expected): void
    {
        $this->getProject()->setProperty('increase_action', $action);
        $this->executeTarget("increase_semver");
        $semver_version =$this->getProject()->getProperty('semver.version');

        $this->assertEquals($semver_version, $expected);
    }

    /**
     * @dataProvider versionIncreaseDataProvider
     */
    public function testVersionIncreaseFromProperty(string $action, string $expected): void
    {
        $this->getProject()->setProperty('increase_action', $action);
        $this->executeTarget("increase_semver_from_property");
        $semver_version =$this->getProject()->getProperty('semver.version');

        $this->assertEquals($semver_version, $expected);
    }

    /**
     * @dataProvider versionIncreaseDataProvider
     */
    public function testVersionIncreaseFromPropertyStoreToDeafult(string $action, string $expected): void
    {
        $this->getProject()->setProperty('increase_action', $action);
        $this->executeTarget("increase_semver_default_property");
        $semver_version =$this->getProject()->getProperty('semversion');

        $this->assertEquals($semver_version, $expected);
    }

    public function versionIncreaseDataProvider(): array
    {
        return [
            ["increase_major", "2.0.0"],
            ["increase_minor", "1.1.0"],
            ["increase_patch", "1.0.1"],
            ["increase_next", "1.1.0"],
            ["increase_stable", "1.1.0"],
            ["increase_alpha", "1.1.0-ALPHA1"],
            ["increase_beta", "1.1.0-BETA1"],
            ["increase_rc", "1.1.0-RC1"],
            ["increase_major", "v2.0.0"],
            ["increase_minor", "v1.1.0"],
            ["increase_patch", "v1.0.1"],
            ["increase_next", "v1.1.0"],
            ["increase_stable", "v1.1.0"],
            ["increase_alpha", "v1.1.0-ALPHA1"],
            ["increase_beta", "v1.1.0-BETA1"],
            ["increase_rc", "v1.1.0-RC1"]
        ];
    }
}
