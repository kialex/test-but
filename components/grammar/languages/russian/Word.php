<?php

namespace app\components\grammar\languages\russian;

use app\components\grammar\WordInterface;
use yii\base\BaseObject;

/**
 * Class Word
 *
 * @property string $word
 * @property string $originalWord;
 */
class Word extends BaseObject implements WordInterface
{
    /**
     * @var array
     */
    public $groups = [
        self::NOUN => [
            'а','ев','ов','ье','иями','ями','ами','еи','ии','и','ией','ей','ой','ий','й','иям','ям','ием','ем','ам',
            'ом','о','у','ах','иях','ях','ы','ь','ию','ью','ю','ия','ья','я','ок', 'мва', 'яна', 'ровать','ег','ги',
            'га','сть','сти'
        ]
    ];

    private $_originalWord;
    private $_word;

    /**
     * Word constructor.
     * @param $word
     */
    public function __construct($word)
    {
        $this->originalWord = $word;
        $this->word = $word;
    }

    /**
     * @return bool
     */
    public function isCorrectLanguage()
    {
        if (preg_match('/[^а-Я]+/msiu', $this->word)) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function isNoun()
    {
        foreach ($this->groups as $wordEnding) {
            $wordEndingLength = mb_strlen($wordEnding);
            if (mb_substr($this->word, -$wordEndingLength) == $wordEnding) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function getWord()
    {
        return $this->_word;
    }

    /**
     * @inheritDoc
     */
    public function setWord($word)
    {
        $this->_word = mb_strtolower(trim($word));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getOriginalWord()
    {
        return $this->_originalWord;
    }

    /**
     * @param string $word
     * @return $this
     */
    public function setOriginalWord($word)
    {
        $this->_originalWord = $word;
        return $this;
    }
}
