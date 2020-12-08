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
            'sender' => $this->encrypt_zigzag($this->encrypt_vigenere($request->get('sender'))),
            'receiver' => $this->encrypt_zigzag($this->encrypt_vigenere($request->get('receiver'))),
            'amount' => $request->get('amount'),
            'message_title' => $this->encrypt_zigzag($this->encrypt_vigenere($request->get('message_title'))),
            'message' => $this->encrypt_zigzag($this->encrypt_vigenere($request->get('message'))),
            'password' => $this->encrypt_zigzag($this->encrypt_vigenere($request->get('password'))),
            'transaction_id' => $data->transaction_id + 1
        ]);
    }

    

    public function get_transaction()
    {
        $datas = Transaction::orderBy('transaction_id', 'desc')->get();
        return $datas->toJson();
    }

    public function get_singletransaction($transaction_id)
    {
        $data = Transaction::where('transaction_id', '=', (int)$transaction_id)->first();   
        $data->toJson();
        return $data;
    }
    public function decrypt_singletransaction($transaction_id,$key){
        $data = Transaction::where('transaction_id','=',(int)$transaction_id)->first();
        if($this->decrypt_vigenere($this->decrypt_zigzag($data->password)) === $key){
            $decrypted_sender = $this->decrypt_vigenere($this->decrypt_zigzag($data->sender));
            $decrypted_message = $this->decrypt_vigenere($this->decrypt_zigzag($data->message));
            $decrypted_message_title = $this->decrypt_vigenere($this->decrypt_zigzag($data->message_title));
            $decrypted_receiver = $this->decrypt_vigenere($this->decrypt_zigzag($data->receiver));
            $data->sender = $decrypted_sender;
            $data->message = $decrypted_message;
            $data->message_title = $decrypted_message_title;
            $data->receiver = $decrypted_receiver;
            return $data->toJson();
        }else{
            return 'error';
        }
    }

    public function encrypt_vigenere($data)
    {
        static $alphabet = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
            'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
            'u', 'v', 'w', 'x', 'y', 'z'
        );

        $key = "ALIG";
        // Output variable defined as empty.
        $output = '';
        // Encrypted variable defined as empty.
        $encrypted = '';
        // The length of the original message.
        $dataSize = strlen($data);
        // The length of the key.
        $keySize = strlen($key);

        // Detecting if the message contains 
        // a non-aplhabetic characters.
        if (preg_match('/[a-z0-9\W\s_]/', $data)) {
            // Replacing those non-alphabetic characters with '', and converting the message
            // to the lowercase letter.
            $editedMessage = strtolower(preg_replace("/[0-9\W\s_]/", '', $data));

            // The length of the edited message.
            $dataSize = strlen($editedMessage);

            // Looping to do the encipher based on how long of the message is.
            for ($i = 0; $i < $dataSize; $i++) {
                // If the value of $i is equal to the length of the key or greater, 
                // then the key will be reset to the beginning.
                if ($i == $keySize || $i > $keySize) {
                    // This variable will contain the shifting index for the key.
                    $a = $i % $keySize;

                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($editedMessage[$i], $alphabet) + array_search(strtolower($key[$a]), $alphabet);
                    // The length of the alphabet which is 26.
                    $y = 26;

                    // The final process of the calculation.
                    $c = fmod($x, $y);

                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if ($c < 0) {
                        $c += abs($y);
                    }
                } else {
                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($editedMessage[$i], $alphabet) + array_search(strtolower($key[$i]), $alphabet);
                    // The length of the alphabet which is 26.
                    $y = 26;

                    // The final process of the calculation.
                    $c = fmod($x, $y);

                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if ($c < 0) {
                        $c += abs($y);
                    }
                }

                // Checking if the value is exist on the alphabet lookup.
                if (isset($alphabet[$c])) {
                    $encrypted .= $alphabet[$c];
                }
            }
        }

        // Counter for the position of the encrypted message.
        $k = 0;

        // This loop has a purpose to reconstruct the encrypted message based on
        // the length of the original messsage itself.
        for ($j = 0; $j < strlen($data); $j++) {
            // If the message on index $j is an alphabetic, then it will return
            // the encrypted message on position $k.
            if (ctype_alpha($data[$j])) {
                // If the letter on message index $j is an uppercase letter,
                // then the output will be converted from lowercase to uppercase.
                if (ctype_upper($data[$j])) {
                    // Appending the output.
                    $output .= strtoupper($encrypted[$k]);

                    // Adding the position counter.
                    $k += 1;
                }
                // Else, just append the encrypted message to the output.
                else {
                    // Appending the output.
                    $output .= $encrypted[$k];

                    // Adding the position counter.
                    $k += 1;
                }
            }
            // Otherwise, it will return the original message on index $j.
            else {
                // Appending the output.
                $output .= $data[($j)];
            }
        }

        // return $output;
        return $output;
    }

    public function codeMessage($text, $rails)
    {
        $codedMessage = array();

        $a = 0;
        $direction = "forwards";

        for ($i = 0; $i < strlen($text); $i++) {

            $currentletter = $text[$i];

            if (!isset($codedMessage[$a])) {
                $codedMessage[$a] = "";
            }
            $codedMessage[$a] .= $currentletter;

            if ($a == 0) {
                $a++;
                $direction = "forwards";
            } elseif ($a == $rails - 1) {
                $a--;
                $direction = "backwards";
            } elseif ($direction == "forwards") {
                $a++;
            } elseif ($direction == "backwards") {
                $a--;
            }
        }
        return $codedMessage;
    }

    public function encrypt_zigzag($text)
    {
        $rails = 3;
        $codedMessage = $this->codeMessage($text, $rails);

        $finalMessage = "";

        foreach ($codedMessage as $chunks) {
            $finalMessage .= $chunks;
        }
        return $finalMessage;
    }
    public function decrypt_vigenere($data)
    {
        //Dekripsi Vigenere
        static $alphabet = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
            'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
            'u', 'v', 'w', 'x', 'y', 'z'
        );

        $key = "ALIG";
        // Output variable defined as empty.
        $output = '';
        // Decrypted variable defined as empty.
        $decrypted = '';
        // The length of the original message.
        $dataSize = strlen($data);
        // The length of the key.
        $keySize = strlen($key);

        // Detecting if the message contains 
        // a non-aplhabetic characters.
        if (preg_match('/[a-z0-9\W\s_]/', $data)) {
            // Replacing those non-alphabetic characters with '', and converting the message
            // to the lowercase letter.
            $editedMessage = strtolower(preg_replace("/[0-9\W\s_]/", '', $data));

            // The length of the edited message.
            $dataSize = strlen($editedMessage);

            // Looping to do the decipher based on how long of the message is.
            for ($i = 0; $i < $dataSize; $i++) {
                // If the value of $i is equal to the length of the key or greater, 
                // then the key will be reset to the beginning.
                if ($i == $keySize || $i > $keySize) {
                    // This variable will contain the shifting index for the key.
                    $a = $i % $keySize;

                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($editedMessage[$i], $alphabet) - array_search(strtolower($key[$a]), $alphabet);
                    // The length of the alphabet which is 26.
                    $y = 26;

                    // The final process of the calculation.
                    $c = fmod($x, $y);

                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if ($c < 0) {
                        $c += abs($y);
                    }
                } else {
                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($editedMessage[$i], $alphabet) - array_search(strtolower($key[$i]), $alphabet);
                    // The length of the alphabet which is 26.
                    $y = 26;

                    // The final process of the calculation.
                    $c = fmod($x, $y);

                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if ($c < 0) {
                        $c += abs($y);
                    }
                }

                // Checking if the value is exist on the alphabet lookup.
                if (isset($alphabet[$c])) {
                    $decrypted .= $alphabet[$c];
                }
            }
        }

        // Counter for the position of the decrypted message.
        $k = 0;

        // This loop has a purpose to reconstruct the decrypted message based on
        // the length of the original messsage itself.
        for ($j = 0; $j < strlen($data); $j++) {
            // If the message on index $j is an alphabetic, then it will return
            // the decrypted message on position $k.
            if (ctype_alpha($data[$j])) {
                // If the letter on message index $j is an uppercase letter,
                // then the output will be converted from lowercase to uppercase.
                if (ctype_upper($data[$j])) {
                    // Appending the output.
                    $output .= strtoupper($decrypted[$k]);

                    // Adding the position counter.
                    $k += 1;
                }
                // Else, just append the decrypted message to the output.
                else {
                    // Appending the output.
                    $output .= $decrypted[$k];

                    // Adding the position counter.
                    $k += 1;
                }
            }
            // Otherwise, it will return the original message on index $j.
            else {
                // Appending the output.
                $output .= $data[($j)];
            }
        }

        // return $output;
        return $output;
    }

    public function decrypt_zigzag($text)
    {
        $rails = 3;
        $lengths = $this->codeMessage($text, $rails);

        $reversedArray = array();

        $message = $text;
        for ($i = 0; $i < count($lengths); $i++) {
            $length = strlen($lengths[$i]);

            $reversedArray[] = substr($message, 0, $length);
            $message = substr($message, $length);
        }

        $decodedMessage = "";

        $k = 0;
        $direction = "forwards";
        for ($i = 0; $i < strlen($text); $i++) {
            $currentLetter = $reversedArray[$k][0];
            $decodedMessage .= $currentLetter;
            $reversedArray[$k] = substr($reversedArray[$k], 1);

            if ($k == 0) {
                $k++;
                $direction = "forwards";
            } elseif ($k == $rails - 1) {
                $k--;
                $direction = "backwards";
            } elseif ($direction == "forwards") {
                $k++;
            } elseif ($direction == "backwards") {
                $k--;
            }
        }

        return $decodedMessage;
    }

}