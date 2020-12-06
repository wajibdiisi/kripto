<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
    }
    public function create_transaction(Request $request)
    {

        $data = Transaction::latest()->first();
        return Transaction::create([
            'sender' => $request->get('sender'),
            'receiver' => $request->get('receiver'),
            'amount' => $request->get('amount'),
            'message_title' => $request->get('message_title'),
            'message' => $request->get('message'),
            'password' => $request->get('password'),
            'transaction_id' => $data->transaction_id + 1
        ]);
    }

    public function encrypt($data)
    {
        // change key to lowercase for simplicity
        $key = "ALIG";
        $key = strtolower($key);

        // intialize variables
        //$vigenere_data = "";
        $ki = 0;
        $kl = strlen($key);
        $length = strlen($data);

        // iterate over each line in encrypted_data
        for ($i = 0; $i < $length; $i++) {
            // if the letter is alpha, encrypt it
            if (ctype_alpha($data[$i])) {
                // uppercase
                if (ctype_upper($data[$i])) {
                    $data[$i] = chr(((ord($data[$ki]) - ord("a") + ord($data[$i]) - ord("A")) % 26) + ord("A"));
                }

                // lowercase
                else {
                    $data[$i] = chr(((ord($data[$ki]) - ord("a") + ord($data[$i]) - ord("a")) % 26) + ord("a"));
                }

                // update the index of key
                $ki++;
                if ($ki >= $kl) {
                    $ki = 0;
                }
            }
        }

        // return the encrypted code
        return $data;

        $rails = 3;
        $encrypted_data = [];
        $position = ($rails * 2) - 2;
        for ($index = 0; $index < strlen($data); $index++) {
            for ($step = 0; $step < $rails; $step++) {
                if (!isset($encrypted_data[$step])) {
                    $encrypted_data[$step] = '';
                }
                if ($index % $position == $step || $index % $position == $position - $step) {
                    $encrypted_data[$step] .= $data[$index];
                } else {
                    $encrypted_data[$step] .= ".";
                }
            }
        }
        return implode('', str_replace('.', '', $encrypted_data));
    }

    public function get_transaction()
    {
        $datas = Transaction::orderBy('transaction_id', 'desc')->get();
        foreach ($datas as $data) {
            $encrypted_sender = $this->encrypt($data->sender);
            $data->sender = $encrypted_sender;
            $encrypted_receiver = $this->encrypt($data->receiver);
            $data->receiver = $encrypted_receiver;
        }
        return $datas->toJson();
    }

    public function get_singletransaction($transaction_id)
    {
        $data = Transaction::where('transaction_id', '=', (int)$transaction_id)->first();
        $encrypted_sender = $this->encrypt($data->sender);
        $encrypted_message = $this->encrypt($data->message);
        $encrypted_message_title = $this->encrypt($data->message_title);
        $data->sender = $encrypted_sender;
        $encrypted_receiver = $this->encrypt($data->receiver);
        $data->receiver = $encrypted_receiver;
        $data->message = $encrypted_message;
        $data->message_title = $encrypted_message_title;
        $data->toJson();
        return $data;
    }

    public function decrypt_singletransaction($transaction_id,$key){
        $data = Transaction::where('transaction_id','=',(int)$transaction_id)->first();
        if($data->password === $key){
            return $data->toJson();
        }else{
            return $this->get_singletransaction($data->transaction_id);
        }
    }

    public function decrypt($ecnrypted_data)
    {
        //Dekripsi Zigzag
        $rails = 3;
        $position = ($rails * 2) - 2;
        $textLength = strlen($ecnrypted_data);

        $minLength = floor($textLength / $position);
        $balance = $textLength % $position;
        $lengths = [];
        $strings = [];
        $totalLengths = 0;
        //find no of characters in each row
        for ($rowIndex = 0; $rowIndex < $rails; $rowIndex++) {
            $lengths[$rowIndex] = $minLength;
            if ($rowIndex != 0 && $rowIndex != ($rails - 1)) {
                $lengths[$rowIndex] += $minLength;
            }
            if ($balance > $rowIndex) {
                $lengths[$rowIndex]++;
            }
            if ($balance > ($rails + ($rails - $rowIndex) - 2)) {
                $lengths[$rowIndex]++;
            }
            $strings[] = substr($ecnrypted_data, $totalLengths, $lengths[$rowIndex]);
            $totalLengths += $lengths[$rowIndex];
        }

        //convert row of characters to plain message
        $data = '';
        while (strlen($data) < $textLength) {
            for ($charIndex = 0; $charIndex < $position; $charIndex++) {
                if (isset($strings[$charIndex])) {
                    $index = $charIndex;
                } else {
                    $index = $position - $charIndex;
                }
                $data .= substr($strings[$index], 0, 1);
                $strings[$index] = substr($strings[$index], 1);
            }
        }
        return $data;

        //Dekripsi Vigenere
        // change key to lowercase for simplicity
        $key = "ALIG";
        $key = strtolower($key);

        // intialize variables
        $decrypted_data = "";
        $ki = 0;
        $kl = strlen($key);
        $length = strlen($data);

        // iterate over each line in text
        for ($i = 0; $i < $length; $i++) {
            // if the letter is alpha, decrypt it
            if (ctype_alpha($data[$i])) {
                // uppercase
                if (ctype_upper($data[$i])) {
                    $x = (ord($data[$i]) - ord("A")) - (ord($key[$ki]) - ord("a"));

                    if ($x < 0) {
                        $x += 26;
                    }

                    $x = $x + ord("A");

                    $text[$i] = chr($x);
                }

                // lowercase
                else {
                    $x = (ord($data[$i]) - ord("a")) - (ord($key[$ki]) - ord("a"));

                    if ($x < 0) {
                        $x += 26;
                    }

                    $x = $x + ord("a");

                    $text[$i] = chr($x);
                }

                // update the index of key
                $ki++;
                if ($ki >= $kl) {
                    $ki = 0;
                }
            }
        }

        // return the decrypted text
        return $decrypted_data;
    }
}
