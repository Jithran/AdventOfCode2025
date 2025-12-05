<?php

class Challenge {
    public $input;
    public $ranges;
    public $products;

    public function __construct($input) {
        $this->input = inpread(__DIR__ . '/' . $input, true);

        $this->ranges = [];
        $this->products = [];

        foreach($this->input AS $line) {
            if(strpos($line, '-') !== false) {
                // range line
                list($min, $max) = explode('-', $line);
                $this->ranges[] = ['min' => (int)$min, 'max' => (int)$max];
            }
            elseif(!empty(trim($line))) {
                // product line
                $this->products[] = (int)$line;
            }
        }
    }

    public function partOne() {
        $totalValid = 0;
        foreach($this->products AS $product) {
            $isValid = false;
            foreach($this->ranges AS $range) {
                if($product >= $range['min'] && $product <= $range['max']) {
                    $isValid = true;
                    break;
                }
            }
            if($isValid) {
                $totalValid++;
            }
        }

        return $totalValid;
    }

    public function partTwo() {
        $ranges = $this->ranges;
        while(true) {
            $mergedRanges = $this->mergeRanges($ranges);
            if(count($mergedRanges) == count($ranges)) {
                // no more merges
                break;
            }
            $ranges = $mergedRanges;
        }

        $totalPossible = 0;

        //dd($mergedRanges);
        foreach($mergedRanges AS $range) {
            $totalPossible += ($range['max'] - $range['min'] +1);
        }   
        return $totalPossible;



        // $possibleProducts = [];
        // foreach($this->ranges AS $range) {
        //     for($i = $range['min']; $i <= $range['max']; $i++) {
        //         $possibleProducts[$i] = true;   
        //     }
        // }
        // return count($possibleProducts);
    }

    private function mergeRanges(array $ranges): array {
        $mergedRanges = [];
        foreach($ranges AS $range) {
            $added = false;
            foreach($mergedRanges AS &$mRange) {
                if(!($range['max'] < $mRange['min'] || $range['min'] > $mRange['max'])) {
                    // overlap, merge
                    $mRange['min'] = min($mRange['min'], $range['min']);
                    $mRange['max'] = max($mRange['max'], $range['max']);
                    $added = true;
                    break;
                }
            }
            if(!$added) {
                $mergedRanges[] = $range;
            }
        }   
        return $mergedRanges;
    }
}