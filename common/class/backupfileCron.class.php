<?php

namespace Cms\common;
class backupfileCron
{
    public static function start()
    {
        global $G;
        $backdir = ROOT . 'data' . DIRECTORY_SEPARATOR . 'backup' . DIRECTORY_SEPARATOR;
        $bakfile = $backdir . 'web' . time() . '.zip';
        $baksql = ROOT . 'bak' . time() . '.sql';


        DbTool::init($G['config']['db']);
        DbTool::backUp($baksql);

        zippath(ROOT, $bakfile, $backdir);
        $history = scanpath($backdir);
        while (count($history) > 10) {
            unlink($history[0]);
            $history = scanpath($backdir);
        }
        unlink($baksql);
        return $bakfile;
    }
}

?>