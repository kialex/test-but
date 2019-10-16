<?php

namespace app\components\grammar\languages\russian\rules;

use app\components\grammar\WordInterface;

class Cases
{
    const caseIm = 'nominative';
    const caseRod = 'genitive';
    const caseDat = 'dative';
    const caseVin = 'accusative';
    const caseTvor = 'instrumentative';
    const casePred = 'prepositional';

    protected $rules = [
        Declension::FIRST => [
            [
                'compare' => ['га', 'ка', 'ха', 'ча', 'ша', 'ща'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'и'],
                    self::caseDat => ['slice' => 1, 'chars' => 'е'],
                    self::caseVin => ['slice' => 1, 'chars' => 'у'],
                    self::caseTvor => ['slice' => 1, 'chars' => 'ой'],
                    self::casePred => ['slice' => 1, 'chars' => 'е']
                ]
            ],
            [
                'compare' => ['ба', 'ва', 'да', 'жа', 'за', 'ла', 'ма', 'на', 'па', 'ра', 'са', 'та', 'фа', 'ца'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'ы'],
                    self::caseDat => ['slice' => 1, 'chars' => 'е'],
                    self::caseVin => ['slice' => 1, 'chars' => 'у'],
                    self::caseTvor => ['slice' => 1, 'chars' => 'ой'],
                    self::casePred => ['slice' => 1, 'chars' => 'е']
                ]
            ],
            [
                'compare' => ['я'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'и'],
                    self::caseDat => ['slice' => 1, 'chars' => 'е'],
                    self::caseVin => ['slice' => 1, 'chars' => 'ю'],
                    self::caseTvor => ['slice' => 1, 'chars' => 'ей'],
                    self::casePred => ['slice' => 1, 'chars' => 'е']
                ]
            ],
            [
                'compare' => ['и'],
                'to' => [
                    self::caseRod => ['slice' => 2, 'chars' => 'ок'],
                    self::caseDat => ['slice' => 1, 'chars' => 'ам'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 1, 'chars' => 'ами'],
                    self::casePred => ['slice' => 1, 'chars' => 'ах']
                ]
            ]
        ],
        Declension::SECOND => [
            [
                'compare' => ['б', 'в', 'г', 'д', 'ж', 'з', 'к', 'л', 'м', 'н', 'п', 'р', 'с', 'т', 'ф', 'х', 'ц', 'ч', 'щ'],
                'to' => [
                    self::caseRod => ['slice' => 0, 'chars' => 'а'],
                    self::caseDat => ['slice' => 0, 'chars' => 'у'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 0, 'chars' => 'ом'],
                    self::casePred => ['slice' => 0, 'chars' => 'е']
                ]
            ],
            [
                'compare' => ['ш'],
                'to' => [
                    self::caseRod => ['slice' => 0, 'chars' => 'а'],
                    self::caseDat => ['slice' => 0, 'chars' => 'у'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 0, 'chars' => 'ем'],
                    self::casePred => ['slice' => 0, 'chars' => 'е']
                ]
            ],
            [
                'compare' => ['о', 'е'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'а'],
                    self::caseDat => ['slice' => 1, 'chars' => 'у'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 0, 'chars' => 'м'],
                    self::casePred => ['slice' => 1, 'chars' => 'е']
                ]
            ],
            [
                'compare' => ['ы'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'ов'],
                    self::caseDat => ['slice' => 1, 'chars' => 'ам'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 1, 'chars' => 'ами'],
                    self::casePred => ['slice' => 1, 'chars' => 'ах']
                ]
            ],
            [
                'compare' => ['ий', 'уй', 'ь'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'я'],
                    self::caseDat => ['slice' => 1, 'chars' => 'ю'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 1, 'chars' => 'ем'],
                    self::casePred => ['slice' => 1, 'chars' => 'е']
                ]
            ]
        ],
        Declension::THIRD => [
            [
                'compare' => ['ь'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'и'],
                    self::caseDat => ['slice' => 1, 'chars' => 'и'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 1, 'chars' => 'ью'],
                    self::casePred => ['slice' => 1, 'chars' => 'и']
                ]
            ],
            [
                'compare' => ['мя'],
                'to' => [
                    self::caseRod => ['slice' => 1, 'chars' => 'ени'],
                    self::caseDat => ['slice' => 2, 'chars' => 'ени'],
                    self::caseVin => ['slice' => 0, 'chars' => ''],
                    self::caseTvor => ['slice' => 1, 'chars' => 'енем'],
                    self::casePred => ['slice' => 1, 'chars' => 'ени']
                ]
            ]
        ]
    ];


    private $_declension;

    public function __construct(Declension $declension)
    {
        $this->_declension = $declension;
    }

    /**
     * @param WordInterface $word
     * @param $case
     *
     * @return mixed
     * @throws \Exception
     */
    public function transform(WordInterface $word, $case)
    {
        $wordLength = mb_strlen($word->getWord());
        $declension = $this->_declension->detect($word);
        foreach ($this->rules[$declension] as $rule) {
            foreach ($rule['compare'] as $compareEnding) {
                $compareEndingLength = mb_strlen($compareEnding);

                if (max(mb_substr($word->getWord(), $wordLength - $compareEndingLength), 0) == $compareEnding) {
                    $start = -1 * abs($rule['to'][$case]['slice']);
                    return $start
                        ? $this->mbSubstrReplace($word->getWord(), $rule['to'][$case]['chars'], $start)
                        : $word->getWord() . $rule['to'][$case]['chars'];
                }
            }
        }

        throw new \Exception('Invalid word');
    }

    protected function mbSubstrReplace($str, $repl, $start, $length = null)
    {
        preg_match_all('/./us', $str, $ar);
        preg_match_all('/./us', $repl, $rar);
        $length = is_int($length) ? $length : mb_strlen($str);
        array_splice($ar[0], $start, $length, $rar[0]);
        return implode($ar[0]);
    }
}
