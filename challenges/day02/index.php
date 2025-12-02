<?php

class Challenge {
    public $input;

    public function __construct($input) {
        $this->input = inpread(__DIR__ . '/' . $input, false);
    }

    public function partOne() {
        $inp = $this->getRanges();

        $ans = 0;
        foreach($inp AS $range) {
            $start = ltrim($range['start'], '0');
            $end = ltrim($range['end'], '0');   

            for($i = $start; $i <= $end; $i++) {
                $len = strlen($i);
                $firstHalf = substr($i, 0, intval($len / 2));
                $secondHalf = substr($i, intval($len / 2));

                if($firstHalf === $secondHalf) {
                    //echo $i . ' '.PHP_EOL;
                    $ans += $i;
                }
            }
        }

        echo $ans;
    }

    public function partTwo() {
        $inp = $this->getRanges();

        $ans = 0;
        foreach($inp AS $range) {
            $start = ltrim($range['start'], '0');
            $end = ltrim($range['end'], '0');   

            for($i = $start; $i <= $end; $i++) {

                $maxChars = floor(strlen($i) / 2);

                for($j = 1; $j <= $maxChars; $j++) {
                    $pattern = substr($i, 0, $j);

                    if(strlen($i) % strlen($pattern) != 0) {
                        continue;
                    }

                    //echo $i . ' - '.$pattern.' - ' . str_pad('', strlen($i), $pattern) .PHP_EOL;
                    if( str_pad('', strlen($i), $pattern) == $i ) {
                        //echo $i . ' '.PHP_EOL;
                        $ans += $i;
                        break;
                    }
                }
            }
        }

        echo $ans;
    }

    private function getRanges() {
        $ranges = explode(',', trim($this->input));
        $result = [];
        foreach($ranges AS $range) {
            list($start, $end) = explode('-', $range);
            $result[] = ['start' => intval($start), 'end' => intval($end)];
        }
        return $result;
    }
}