<?php
/*================================== Settings Script ==================================*/
//  COMPOSER TIMER                                                                     //
//  Timer used in tests. Based on SebastianBergmann\Timer\Timer.                       //
/*-------------------------------------------------------------------------------------*/

/*----------------------------------- REQUIREMENTS ------------------------------------*/
    /* Adding Timer From Composer */
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
    use SebastianBergmann\Timer\Timer;
/*-------------------------------------------------------------------------------------*/

    class Stopwatch
    {
        private $timer;
        private $duration;

        function __construct()
        {
            $this->timer =  new Timer;
            $this->duration = 0;
        }
        
        public function start()
        {
            $this->timer->start();
        }
        
        public function stop()
        {
            $this->duration = $this->timer->stop();
        }

        public function print_time()
        {
            echo "Class Name: "  . get_class($this->duration) . "\n";
            echo "Time Taken: "  . $this->duration->asString() . "\n";
            echo "Seconds: "     . $this->duration->asSeconds() . "\n";
            echo "Milliseconds: ". $this->duration->asMilliseconds() . "\n";
            echo "Microseconds: ". $this->duration->asMicroseconds() . "\n";
            echo "Nanoseconds: " . $this->duration->asNanoseconds() . "\n";
        }
    }
?>