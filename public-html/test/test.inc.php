<?php
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