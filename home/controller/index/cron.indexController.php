<?php
ignore_user_abort(1);
@set_time_limit(0);
$sys_cron = config::get_cron();
if ($sys_cron['enable'] == 1) {
    $starttime = time();
    //刷新网络任务 由于主机执行时间限制 所以时间重置从当前时间开始
    if (time() - $sys_cron['dateline'] < 5) {
        config::update_cron(array('enable' => '0'));
        while ($sys_cron['enable'] != -1) {
            sleep(1);
            $sys_cron = config::get_cron();
        }
    }
    config::update_cron(array('enable' => '1'));

    while (1) {

        get(U('home/index/cronrun'), 1);//异步执行任务


        if (time() - $starttime > $G['config']['app']['croncalltime'] && $starttime) {
            $url = U('home/index/cron');
            get($url, 1);//超时调用自身 重新计时
            $starttime = false;
        }
        file_put_contents(ROOT . 'test.txt', date('Y-m-d H:i:s', time()) . "\r\n" . date('Y-m-d H:i:s', $starttime) . "\r\n");
        sleep(1);
        config::update_cron(array('dateline' => time()));
        $sys_cron = config::get_cron();
        if (!$sys_cron['enable'])
            break;
    }
    config::update_cron(array('enable' => '-1'));
} elseif (!$sys_cron['enable']) {
    echo 'No open function';
}
?>