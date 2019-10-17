<?php

namespace app\models;

use yii\db\ActiveQuery;

class WordQuery extends ActiveQuery
{
    public function topUsers($userNumber = 10, $interval = 7)
    {
        return $this
            ->select([
                'user_ip',
                'word',
                'COUNT(word) as word_count',
                'FROM_UNIXTIME(`created_at`) as date'
            ])
            ->having('date > NOW() - INTERVAL ' . $interval . ' DAY AND word_count > 3')
            ->groupBy('word, user_ip')
            ->orderBy(['word_count' => SORT_DESC])
            ->limit($userNumber)
            ->asArray()->all();
    }
}