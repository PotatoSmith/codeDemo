<?php
declare(strict_types=1);
// 单链表反转
// 链表中环的检测
// 两个有序的链表合并
// 删除链表倒数第 n 个结点
// 求链表的中间结点


class Node
{
    public $data; // 节点数据
    public $next; // 节点指针

    public function __construct(int $data=null, int $next=null)
    {
        $this->data = $data;
        $this->next = $next;
    }

}


class LinkList
{
    private $head; // 头节点

    public function insertHead(int $data): bool
    {
        $newNode = new Node($data);
        $newNode->next = $this->head;
        $this->head = $newNode;

        return true;
    }

    // 链表插入
    public function insert(int $data, int $index=0): bool
    {
        if ($index < 0) {
            return false;
        }

        $node = new Node($data);
        // 头部不存在或者索引为0
        if (is_null($this->head) || $index === 0) {
            return $this->insertHead($data);
        }

        $currNode = $this->head;
        $startIndex = 1;

        for ($currIndex = $startIndex; !is_null($currNode); ++$currIndex) {
            if ($currIndex === $index) {
                $newNode = new Node($data);
                $newNode->next = $currNode->next;
                $currNode->next = $newNode;

                return true;
            }
            // 移动到下一个节点
            $currNode = $currNode->next;
        }

        return false;
    }

    public function remove(int $index): bool
    {
        if (is_null($this->head)) {
            return false;
        } elseif ($index === 0) {
            $this->head = $this->head->next;
        }

        $startIndex = 1;
        $currNode = $this->head;

        for ($i = $startIndex; !is_null($currNode->next); ++$i) {
            if ($index === $i) {
                $currNode->next = $currNode->next->next;
                break;
            }
            $currNode = $currNode->next;
        }
        return true;
    }

    // 查看链表
    public function view(): string
    {
        $str = '';
        $currNode = $this->head;
        for ($currIndex=0; !is_null($currNode); $currIndex++) {
            $str .= $currNode->data . '-';
            $currNode = $currNode->next;
        }
        return trim($str, '-');
    }

    public function revers(): bool
    {

        if (is_null($this->head)) {
            return false;
        }

        $currNode = $this->head;
        $pre = null;
        while ($currNode) {
            $tmp = $currNode->next;
            $currNode->next = $pre;
            $pre = $currNode;
            $currNode = $tmp;
        }

        $this->head = $pre;
        return true;
    }
}

$class = new LinkList();

$class->insert(1);
$class->insert(3, 1);
$class->insert(5, 2);
$class->insert(7, 3);
$class->insert(9, 4);
// $r = $class->view();
// print_r($r);
// echo PHP_EOL;
// $class->remove(2);
$class->revers();
$r = $class->view();
print_r($r);