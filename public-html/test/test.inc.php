<?php
    require_once __DIR__ . '/../../config/config.inc.php';
    require_once COMPOSER;
    use SebastianBergmann\Timer\Timer;

    function print_time($duration)
    {
        echo "Class Name: "  . get_class($duration) . "\n";
        echo "Time Taken: "  . $duration->asString() . "\n";
        echo "Seconds: "     . $duration->asSeconds() . "\n";
        echo "Milliseconds: ". $duration->asMilliseconds() . "\n";
        echo "Microseconds: ". $duration->asMicroseconds() . "\n";
        echo "Nanoseconds: " . $duration->asNanoseconds() . "\n";
    }
?>