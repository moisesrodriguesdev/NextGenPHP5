<?php

class TaskMgr
{
    public $tasks = [];

    public function add($t, $p, $d)
    {
        if ($t != '') {
            if ($p >= 1 && $p <= 5) {
                $this->tasks[] = [
                    'txt' => $t,
                    'pri' => $p,
                    'done' => false,
                    'dl' => $d,
                ];
            }
        }
    }

    public function complete($i)
    {
        if (isset($this->tasks[$i])) {
            if ($this->tasks[$i]['done'] == false) {
                $this->tasks[$i]['done'] = true;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getByPri($p)
    {
        $r = [];
        foreach ($this->tasks as $t) {
            if ($t['pri'] == $p) {
                if ($t['done'] == false) {
                    $r[] = $t;
                }
            }
        }
        return $r;
    }

    public function report()
    {
        $o = "TAREFAS\n";
        $dn = 0; $pn = 0; $at = 0;
        foreach ($this->tasks as $t) {
            if ($t['done'] == true) {
                $dn++;
            } else {
                $pn++;
                if ($t['dl'] != null && $t['dl'] < date('Y-m-d')) {
                    $at++;
                    $o .= "[ATRASADA] ";
                }
            }
            $o .= $t['txt'] . ' (P' . $t['pri'] . ')';
            $o .= $t['done'] ? ' ✓' : ' ✗';
            $o .= "\n";
        }
        $o .= "---\nFeitas: $dn | Pendentes: $pn | Atrasadas: $at\n";
        return $o;
    }
}
