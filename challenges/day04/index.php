<?php

class Challenge {
    public $input;

    public function __construct($input) {
        $this->input = inpread(__DIR__ . '/' . $input, true);
    }

    public function partOne() {
        $strInput = $strOutput = implode('', $this->input);
        $rowLength = strlen($this->input[0]);
        $arr_check_pos = [
            -$rowLength - 1, -$rowLength, -$rowLength + 1, 
            -1,                 +1,
            $rowLength - 1,  $rowLength,  $rowLength + 1
        ];

        $ans = 0;
        $len = strlen($strInput);
        //dump('Input: ' . $strInput);
        for($i = 0; $i < $len; $i++) {
            $char = $strInput[$i];
            if($char != '@') {
                continue;
            }
            $isSurrounded = 0;
            foreach($arr_check_pos AS $pos) {
                $checkPos = $i + $pos;
                if($checkPos < 0 || $checkPos >= $len) {
                    continue;
                }

                // if we are at the start of a row, skip left checks
                if($i % $rowLength == 0) {
                    if(in_array($pos, [-$rowLength - 1, -1, $rowLength - 1])) {
                        continue;
                    }
                }
                // if we are at the end of a row, skip right checks
                if(($i + 1) % $rowLength == 0) {
                    if(in_array($pos, [-$rowLength + 1, +1, $rowLength + 1])) {
                        continue;
                    }
                }

                if($strInput[$checkPos] == '@') {
                    $isSurrounded++;
                }
            }

            //dump('Pos ' . ($i+1) . ' is surrounded by ' . $isSurrounded . ' @ chars.');
            if($isSurrounded < 4) {
                $ans++; 
                //$strOutput[$i] = 'x';
            }
            $strOutput[$i] = $isSurrounded;
        }

        dump('Output: ' .PHP_EOL . implode(PHP_EOL, str_split($strOutput, $rowLength)));

        return $ans;
    }

    public function partTwo() {
        $inp = $this->input;
        $ans = 0;

        while(true) {
            $res = $this->removeRols($inp);
            $inp = $res['output'];
            $ans += $res['ans'];
            if($res['ans'] == 0) {
                break;
            }
        }

        dump('Rolls that can not be removed: ' .PHP_EOL . implode(PHP_EOL, $inp));

        return $ans;
    }

    private function removeRols(array $input): array {
        $strInput = $strOutput = implode('', $input);
        $rowLength = strlen($input[0]);
        $arr_check_pos = [
            -$rowLength - 1, -$rowLength, -$rowLength + 1, 
            -1,                 +1,
            $rowLength - 1,  $rowLength,  $rowLength + 1
        ];

        $ans = 0;
        $len = strlen($strInput);
        //dump('Input: ' . $strInput);
        for($i = 0; $i < $len; $i++) {
            $char = $strInput[$i];
            if($char != '@') {
                continue;
            }
            $isSurrounded = 0;
            foreach($arr_check_pos AS $pos) {
                $checkPos = $i + $pos;
                if($checkPos < 0 || $checkPos >= $len) {
                    continue;
                }

                // if we are at the start of a row, skip left checks
                if($i % $rowLength == 0) {
                    if(in_array($pos, [-$rowLength - 1, -1, $rowLength - 1])) {
                        continue;
                    }
                }
                // if we are at the end of a row, skip right checks
                if(($i + 1) % $rowLength == 0) {
                    if(in_array($pos, [-$rowLength + 1, +1, $rowLength + 1])) {
                        continue;
                    }
                }

                if($strInput[$checkPos] == '@') {
                    $isSurrounded++;
                }
            }

            //dump('Pos ' . ($i+1) . ' is surrounded by ' . $isSurrounded . ' @ chars.');
            if($isSurrounded < 4) {
                $ans++; 
                $strOutput[$i] = '.';
            }
        }

        //dump('Output: ' .PHP_EOL . implode(PHP_EOL, str_split($strOutput, $rowLength)));

        return [
            'ans' => $ans,
            'output' => str_split($strOutput, $rowLength)
        ];
    }
}