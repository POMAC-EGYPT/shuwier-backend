<?php

namespace App\Console\Commands;

use App\Helpers\ImageHelpers;
use App\Models\PortfolioAttachment;
use Illuminate\Console\Command;

class CleanUnusedAttachments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attachments:clean {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean unused attachments for the given type';

    private array $strategies = [
        'portfolio' => PortfolioAttachment::class,
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');

        if (!$type || !isset($this->strategies[$type])) {
            $this->error("Invalid type. Available types: " . implode(', ', array_keys($this->strategies)));
            return Command::FAILURE;
        }

        $repo = app($this->strategies[$type]);

        $attachments = $repo->query()
            ->whereNull('portfolio_id')
            ->where('created_at', '<', now()->subDay())
            ->get();

        foreach ($attachments as $attachment) {
            ImageHelpers::deleteImage($attachment->file_path);
            $attachment->delete();
        }

        $this->info("Deleted {$attachments->count()} unused {$type} attachments.");

        return Command::SUCCESS;
    }
}
