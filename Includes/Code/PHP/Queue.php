<?php
    // Implementing a Queue (Using OOP for fun)
    class Queue{
        // A limit is not necessary
        protected $queue;
        protected $front;
        protected $rear;
        protected $size;

        public function __construct($limit = 10){
            // Initializing the queue as an array
            $this->queue = array();

            // Setting a Limit to the Max Size of the Array
            $this->size = $limit;

            // Initializing the front and rear
            $this->front = -1;
            $this->rear = 0;
        }
        
        public function peek() {
            // See the value at the front of the queue
            if ($this->isEmpty()){
                return "The Queue is Empty";    // FIXME: Delete this part later
            }
            else{
                return $this->queue[$this->front];
            }
        }

        public function isFull() {
            // Checks whether the queue is full
            if ($this->rear == $this->size){
                return true;
            }
            else{
                return false;
            }
        }

        public function isEmpty() {
            // Checks whether the Queue is empty
            if(($this->front) < 0 || ($this->front) > ($this->rear)){
                return true;
            }
            else{
                return false;
            }
        }

        public function enqueue($value) {
            if($this->isFull()){
                return false;
            }
            else if($this->isEmpty()){
                // Adding data to the end of the queue
                $this->front++; // FIXME: Remove Redundancy
                $this->queue[$this->rear] = $value;
                $this->rear++;
                return true;
            }
            else{
                $this->queue[$this->rear] = $value;
                $this->rear++;
                return true;
            }
        }
        
        public function dequeue() {
            if($this->isEmpty()){
                return FALSE;
            }
            else {
                // Gets the value from the front of the queue and then shifts the pointer to the next element
                $value = $this->queue[$this->front];
                $this->front++;
                return $value;
            }
        }

        // TO: Help with Troubleshooting
        public function printQueue(){
            echo "<pre>";
            print_r($this->queue);
            echo "</pre>";
        }
    }
?>