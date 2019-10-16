<?php

namespace app\components\grammar\languages\russian\rules;

use app\components\grammar\WordInterface;

class Declension
{
    const FIRST = 1;
    const SECOND = 2;
    const THIRD = 3;

    public $wordEnding = [
        self::FIRST => ['а', 'я', 'и'],
        self::SECOND => ['о', 'е', 'ы', 'ль', 'варь', 'брь'],
        self::THIRD => ['мя', 'ь'],
    ];

    /**
     * @param WordInterface $word
     * @return int
     *
     * @throws \Exception
     */
    public function detect(WordInterface $word)
    {
        foreach ($this->wordEnding as $declension => $wordEndings) {
            foreach ($wordEndings as $wordEnding) {
                $length = mb_strlen($wordEnding);
                if ($wordEnding == mb_substr($word->getWord(), -1 * abs($length))) {
                    return $declension;
                }
            }
        }

        return self::SECOND;
    }
}
