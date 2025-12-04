<?php

class Challenge {
    public $input;

    public function __construct($input) {
        $this->input = inpread(__DIR__ . '/' . $input, true);
    }

    public function partOne() {
        $total = 0;
        foreach($this->input AS $val) {
            $digits = str_split($val);
            $len = count($digits);

            $best = -1;

            for ($i = 0; $i < $len; $i++) {
                for ($j = $i + 1; $j < $len; $j++) {
                    $value = intval($digits[$i] . $digits[$j]);
                    if ($value > $best) {
                        $best = $value;
                    }
                }
            }
            $total += $best;    
            //dump($val . ' => ' . $best);
        }
        echo $total;
    }

    public function partTwo() {
        $total = 0;
        $maxlen = 12;
        foreach($this->input AS $val) {
            $highest = $this->maxSubsequence($val, $maxlen);
            //dump($val . ' -> ' . $highest);
            $total += intval($highest);
        }

        echo $total;    
    }

    private function maxSubsequence(string $val, int $k): string
    {
        $digits = str_split($val);
        $n = count($digits);
        $toDrop = $n - $k;
        $stack = [];

        foreach ($digits as $d) {
            while (
                $toDrop > 0
                && !empty($stack)
                && end($stack) < $d
            ) {
                array_pop($stack);
                $toDrop--;
            }

            $stack[] = $d;
        }

        if (count($stack) > $k) {
            $stack = array_slice($stack, 0, $k);
        }

        return implode('', $stack);
    }
}