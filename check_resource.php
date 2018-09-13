<?php


class AutoPushStaticResource {

    //检测git状态 true继续 false 退出
    private function checkGitStatus() {
        $cmd = "git status";
        exec($cmd, $status);
        $no_need_run =  ($status[4] == "nothing to commit, working tree clean");
        if ($no_need_run) {
            echo 'working tree clean' . PHP_EOL;
            exit();
        }
    }

    private function gitPull() {
        $cmd = "git pull origin master";
        exec($cmd, $status);
    }

    private function gitAddAll() {
        $cmd = "git add -A";
        exec($cmd, $status);
    }

    private function gitCommitAndPush() {
        $commit_id = md5(time());
        $cmd = "git commit -m '{$commit_id}'";
        exec($cmd, $status1);
        $cmd = "git push origin master";
        exec($cmd, $status2);
        echo "commit_id:{$commit_id}" . PHP_EOL;
    }

    public function main() {
        $this->gitAddAll();
        $this->checkGitStatus();
        $this->gitPull();
        $this->gitAddAll();
        $this->gitCommitAndPush();
    }


}


$obj = new AutoPushStaticResource;
$obj->main();
