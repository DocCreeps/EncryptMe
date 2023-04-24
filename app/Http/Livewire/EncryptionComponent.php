<?php
namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class EncryptionComponent extends Component
{
    public $input;
    public $mode;
    public $key;
    public $output;

    public function index()
    {
        return view('encryption');
    }

    public function submit()
    {
        return view('encryption', ['output' => $this->encrypt($this->input, $this->mode, $this->key)]);
    }

    public function encrypt(Request $request)
    {
        $input = $request->input('input');
        $mode = $request->input('mode');
        $key = $request->input('key');

        switch ($mode) {
            case 'cesar':
                $output = $this->cesarEncrypt($input, $key);
                break;
            case 'vigenere':
                $output = $this->vigenereEncrypt($input, $key);
                break;
            default:
                $output = '';
                break;
        }
      $this->output = $output;
    }

    public function decrypt(Request $request)
    {
        $input = $request->input('input');
        $mode = $request->input('mode');
        $key = $request->input('key');

        switch ($mode) {
            case 'cesar':
                $output = $this->cesarDecrypt($input, $key);
                break;
            case 'vigenere':
                $output = $this->vigenereDecrypt($input, $key);
                break;
            default:
                $output = '';
                break;
        }

        return view('encryption', ['output' => $output]);
    }

    private function cesarEncrypt($input, $key)
    {
        // Code de chiffrement de César
        $result = '';
        $length = strlen($input);
        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];
            if (ctype_alpha($char)) {
                $ascii = ord($char);
                $ascii += $key;
                if ($ascii > ord('z')) {
                    $ascii -= 26;
                }
                $result .= chr($ascii);
            } else {
                $result .= $char;
            }
        }
        return $result;
    }

    private function cesarDecrypt($input, $key)
    {
        // Code de déchiffrement de César
        return $this->cesarEncrypt($input, 26 - $key);
    }

    private function vigenereEncrypt($input, $key)
    {
        // Code de chiffrement de Vigenère
        $key = strtoupper(preg_replace('/[^a-zA-Z]/', '', $key));
        $keyLength = strlen($key);
        $result = '';
        $j = 0;
        $length = strlen($input);
        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];
            if (ctype_alpha($char)) {
                $ascii = ord($char);
                $shift = ord($key[$j % $keyLength]) - ord('A');
                $j++;
                $ascii += $shift;
                if ($ascii > ord('Z')) {
                    $ascii -= 26;
                }
                $result .= chr($ascii);
            } else {
                $result .= $char;
            }
        }
        return $result;
    }

    private function vigenereDecrypt($input, $key)
    {
        // Code de déchiffrement de Vigenère
        $key = strtoupper(preg_replace('/[^a-zA-Z]/', '', $key));
        $keyLength = strlen($key);
        $result = '';
        $j = 0;
        $length = strlen($input);
        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];
            if (ctype_alpha($char)) {
                $ascii = ord($char);
                $shift = ord($key[$j % $keyLength]) - ord('A');
                $j++;
                $ascii -= $shift;
                if ($ascii < ord('A')) {
                    $ascii += 26;
                }
                $result .= chr($ascii);
            } else {
                $result .= $char;
            }
        }
        return $result;
    }

    public function render()
    {
        return view('livewire.encryption-component');
    }
}
