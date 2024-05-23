<?php

/*
 * This file is part of consoletvs/profanity.
 *
 * (c) Erik Campobadal <soc@erik.cat>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This is the profanity class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Blocker
{
    public $dictionary;
    public $blocker;
    public $text;
    public $strict = false;
    public $strictClean = true;

    /**
     * Setup the Profanity filter.
     *
     * @param string $text
     *
     * @return void
     */
    public function __construct($text, $blocker)
    {
        $this->text = $text;
        $this->blocker = $blocker;
        $this->dictionary = json_decode(file_get_contents(__DIR__.'/Dictionaries/Default.json'), true);
    }

    /**
     * Set the text to filter.
     *
     * @param string $text
     *
     * @return self
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the strict mode.
     *
     * @param bool $strict
     *
     * @return self
     */
    public function strict($strict)
    {
        $this->strict = $strict;

        return $this;
    }

    /**
     * Set the strict clean mode.
     *
     * @param  bool $strict
     * @return self
     */
    public function strictClean($strict)
    {
        $this->strictClean = $strict;

        return $this;
    }

    /**
     * Set the blocker string (string that will replace bad words).
     *
     * @param string $blocker
     *
     * @return self
     */
    public function blocker($blocker)
    {
        $this->blocker = $blocker;

        return $this;
    }

    /**
     * Set the blocker dictionary (string = path to json, array = dictionary) (bad words).
     *
     * @param mixed $dictionary
     *
     * @return self
     */
    public function dictionary($dictionary)
    {
        $this->dictionary = is_array($dictionary) ? $dictionary : json_decode(file_get_contents($dictionary), true);

        return $this;
    }

    /**
     * Return true if the text is clean.
     *
     * @return bool
     */
    public function clean()
    {
        return count($this->badWords()) == 0;
    }

    /**
     * Return the bad words contained in the text.
     *
     * @return array
     */
    public function badWords()
    {
        $words = explode(' ', strtolower($this->text));
        $badwords = array();
        foreach ($this->dictionary as $bad_word) {
            if (($this->strict && str_contains(strtolower($this->text), strtolower($bad_word['word']))) || (in_array(strtolower($bad_word['word']), $words)) ) {
                $badwords[]= array(
                    'language'=>$bad_word['language'],
                    "word"=>strtolower($bad_word['word']));
            }
        }
        return $badwords;
    }


    /**
     * Returns the blocked word.
     *
     * @param  string $word
     * @return string
     */
    private function blockWord($word)
    {
        if ($this->strictClean) {
            return str_repeat($this->blocker[0], strlen($word));
        }

        return $this->blocker;
    }
}
