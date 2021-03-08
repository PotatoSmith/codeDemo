<?php

// 主题　被观察者
interface SplSubjectMy {
    public function attach($observer); // 注册观察者到当前主题
    public function detach($observer); // 从当前主题删除观察者
    public function notify();          // 主题状态更新　通知所有观察者做相应处理
}

// 观察者
interface SplObserverMy {
    public function update($subject); // 注册观察者到当前主题
}

class User implements SplSubjectMy
{
    public $name;
    public $email;
    public $mobile;

    private $observers = [];

    public function register($name, $email, $mobile)
    {
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;

        $reg_result = true;
        if ($reg_result) {
            $this->notify();
            return true;
        }
        return false;
    }

    public function attach($observer)
    {
        return array_push($this->observers, $observer);
    }

    public function detach($observer)
    {
        $key = array_search($observer, $this->observers, true);
        if ($key !== false) {
            unset($this->observers[$key]);
            return true;
        }
        return false;
    }

    public function notify()
    {
        if (!empty($this->observers)) {
            foreach ($this->observers as $k => $observer) {
                $observer->update($this);
            }
        }
        return true;
    }
}

class EmailObserver implements SplObserverMy
{
    public function update($user)
    {
        echo "send mail to" . $user->email . PHP_EOL;
    } 
}

class SmsObserver implements SplObserverMy
{
    public function update($user)
    {
        echo "send mobile to" . $user->mobile . PHP_EOL;
    }
}

$user = new User();
$emailObserver = new EmailObserver();
$user->attach($emailObserver);

$smsObserver = new SmsObserver();
$user->attach($smsObserver);

$user->register('Potato', 'liquan.sun@qq.com', 13912345678);