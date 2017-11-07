# UnitTest profiler

Small library for showing how much time every test took to run.

# Installation

```console
$ composer require santik/phpunit-profiler
```

# Configuration

Add following lines in your phpunit.xml file.

```
<listeners>
        ...
        <listener class="ProfilingTestListener" file="PATH_TO_DIRECTORY_WITH_LIBRARY/ProfilingTestListener.php">
            <arguments>
                <double>0.015</double><!--seconds-->
                <double>0.001</double><!--seconds-->
            </arguments>
        </listener>
        ....
    </listeners>

```
