<?php

namespace App\Console\Commands;

use App\Models\InvitationUser;
use App\Repository\Contracts\InvitationFreelancerRepositoryInterface;
use Illuminate\Console\Command;

class RemoveExpiredInvitationEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invitations:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove invitation emails that expired more than 7 days ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        InvitationUser::where('expired_at', '<', now()->subDays(7))->delete();
    }
}
