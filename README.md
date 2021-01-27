# Semver task ![Github Test](https://github.com/pavlot/phing-task-semver/workflows/Github%20Test/badge.svg)
[Phing](https://www.phing.info/) task to manipulate versions in Semver format

# Parameters

# Usage examples

Simplest usecase: you just provide what type of `action` you'd like to perform, `version` string and `property` where new value will be stored

```xml
    <target name="increase_semver">
        <SemverTask action="increase_minor" version="1.0.0" property="semver.version"/>
        <echo msg="Semver version: ${semver.version}"/>
    </target>
```
If `property` is not given, then result stored to `semversion` property

```xml
    <target name="increase_semver_default_property">
        <SemverTask action="increase_minor" version="1.0.0"/>
        <echo msg="Semver version: ${semversion}"/>
    </target>
```
For sure `version` attrubute could be from some external property

```xml
    <target name="increase_semver_from_property">
        <property name="version" value="1.0.0"/>
        <SemverTask action="increase_minor" version="${version}" property="semver.version"/>
        <echo msg="Semver version: ${semver.version}"/>
    </target>
```
