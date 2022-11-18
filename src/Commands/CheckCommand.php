<?php

namespace Laravel\Pulse\Commands;

use Illuminate\Console\Command;

class CheckCommand extends Command
{
    /**
     * The command's signature.
     *
     * @var string
     */
    public $signature = 'pulse:check';

    /**
     * The command's description.
     *
     * @var string
     */
    public $description = 'Take a snapshot of the current server\'s pulse';

    /**
     * Handle the command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('Total space: '.(number_format(disk_total_space('/') / 1024 / 1024 / 1024, 2)).'GB');
        $this->line('Free space: '.(number_format(disk_free_space('/') / 1024 / 1024 / 1024, 2)).'GB');

        // Total memory (Mac): hostinfo | grep 'Primary memory available:' | grep -Eo '[0-9]+' | head -n 1
        // Total memory (Linux): cat /proc/meminfo | grep MemTotal | grep -E -o '[0-9]+'

        // Used memory (Mac): top -l 1 | grep "Mem:" | grep -Eo '[0-9]+' | head -n 1
        // Used memory (Linux): top -l 1 | grep "Mem:" | grep -Eo '[0-9]+' | head -n 1

        // Available memory (Linux): free -m | head -2 | tail -1 | grep -Eo '[0-9]+' | tail -1

        // CPU % (Mac): top -l  2 | grep -E "^CPU" | tail -1 | awk '{ print $3 + $5 }'
        // CPU % (Linux): top -bn2 | grep '%Cpu(s)' | tail -1 | grep -Eo '[0-9]+\.[0-9]+' | head -n 4 | tail -1 | awk '{ print 100 - $1 }'
    }
}
