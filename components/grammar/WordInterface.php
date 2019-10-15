<?php

namespace app\components\grammar;

interface WordInterface
{
    const NOUN = 'noun';

    public function __construct($word);

    /**
     * @return bool
     */
    public function isCorrectLanguage();

    /**
     * @return bool
     */
    public function isNoun();

    /**
     * @return string
     */
    public function getWord();

    /**
     * @param string $word
     * @return WordInterface
     */
    public function setWord($word);

    /**
     * @return string
     */
    public function getOriginalWord();
}
