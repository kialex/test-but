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
     * @param string $word
     * @throws \Exception
     */
    public function __construct($word)
    {
        if (mb_strlen($word) == 0) {
            throw new \Exception('Word should not be empty');
        }

        $this->originalWord = $word;
        $this->word = $word;

        if (!$this->isCorrectLanguage()) {
            throw new \Exception('Word should contains Russian characters');
        }

        parent::__construct();
    }

    /**
     * @return bool
     */
    public function isCorrectLanguage()
    {
        if (preg_match('/[А-Яа-яЁё]/u', $this->word)) {
            return true;
        }

        return false;
    }

    /**
     * TODO
     * @inheritDoc
     */
    public function isNoun()
    {
        foreach ($this->groups[self::NOUN] as $wordEnding) {
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
