<?php

class Lend {
    const MONEY = 100000;       // 本金
    const RATE = 0.1;           // N个月利率
    const PER_PERSON = 10000;   // 一个人需要借多少钱
    const MONTH = 12;           // 分N个月归还

    private $aMy = [];      // 我的信息

    private $aList = [];    // 借款人明细

    private $id = 0;        // 借款人id 自增变量

    public function __construct()
    {
        $this->aMy = [
            'in' => self::MONEY,
            'out' => 0,
        ];
        
        $this->lend();
    }

    // 预测第N个月时资产情况
    public function predict($n) {
        for ($i=1; $i<=$n; $i++) {
            $this->_checkOut();
        }
        return $this->view();
    }

    // 月结算
    private function _checkout() {
        foreach ($this->aList as $index => &$person) {
            $person['month']++;
            if ($person['month'] === 1) { // 首次还款 归还全部利息和第一个月本金
                $amount = round(self::RATE * self::PER_PERSON + self::PER_PERSON / self::MONTH, 2);
            } else {
                $amount = round(self::PER_PERSON / self::MONTH, 2);
            }

            $this->aMy['in'] += $amount;
            $this->aMy['out'] -= $amount;

            $person['arrears'] -= $amount;
            if ($person['month'] === self::MONTH) { // 还清了账单
                unset($this->aList[$index]);
                $this->aList = array_values($this->aList);
            }
        }
        $this->lend(); // 继续外借
    }

    // 外借
    public function lend()
    {
        while ($this->aMy['in'] >= self::PER_PERSON) {
            $this->_lend();
        }
    }

    private function _lend()
    {
        $this->aMy['in'] -= self::PER_PERSON;
        $amount = round((1+self::RATE) * self::PER_PERSON, 2);
        $this->aList[] = [
            'id' => ++$this->id,
            'arrears' => $amount,
            'month' => 0
        ];
        $this->aMy['out'] += $amount;
    }

    // 查看
    public function view()
    {
        return [
            'my' => $this->aMy,
            'list' => $this->aList,
        ];
    }

}

$o = new Lend();
$r = $o->predict(10);

echo "手中金额,未归还欠款\n";
echo "{$r['my']['in']},{$r['my']['out']}\n";
echo "借款人编号,未结清欠款,已还款月数\n";
foreach ($r['list'] as $item) {
    echo "{$item['id']},{$item['arrears']},{$item['month']}\n";
}