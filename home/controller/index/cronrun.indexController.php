<?php
ignore_user_abort(1);
@set_time_limit(0);
$sys_cron = config::get_cron();

$sys_cron['value'] = json_decode($sys_cron['value'], 1);
foreach ($sys_cron['value'] as $k => $v) {
    if ($v['exectime'] < time() && $v['status']) {
        if ($v['type'] == 'class') {
            $v['key']::start();
        }
        //执行完任务计算下一次执行时间
        while (time() > $v['exectime']) {
            $v['exectime'] += $v['intervaltime'];
        }
        $v['lasttime'] = time();
        $sys_cron['value'][$k] = $v;
        $sys_cron['value'] = json_encode($sys_cron['value'], JSON_UNESCAPED_UNICODE);
        config::update_cron(array('value' => $sys_cron['value']));
    }
}
?>