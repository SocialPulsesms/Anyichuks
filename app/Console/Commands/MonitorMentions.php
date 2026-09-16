<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MonitoringProvider;
use App\Services\MediaIntelligenceService;

class MonitorMentions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:monitor {--provider= : Sync a specific provider by name or ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Poll configured media providers for new mentions of tracked keywords';

    /**
     * The media intelligence pipeline service.
     */
    protected $service;

    /**
     * Create a new command instance.
     */
    public function __construct(MediaIntelligenceService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting Media Intelligence sync run...');

        $providerOpt = $this->option('provider');
        
        $query = MonitoringProvider::where('is_enabled', true);
        
        if ($providerOpt) {
            if (is_numeric($providerOpt)) {
                $query->where('id', $providerOpt);
            } else {
                $query->where('name', 'like', "%{$providerOpt}%");
            }
        }

        $providers = $query->get();

        if ($providers->isEmpty()) {
            $this->warn('No enabled monitoring providers found to sync.');
            return 0;
        }

        foreach ($providers as $provider) {
            $this->info("Syncing provider: {$provider->name} (Type: {$provider->type})...");
            
            $result = $this->service->syncProvider($provider);
            
            if ($result['status'] === 'success') {
                $this->info("Success! Fetched: {$result['fetched']}, Accepted: {$result['accepted']}, Rejected: {$result['rejected']}");
            } else {
                $this->error("Failed syncing provider {$provider->name}: {$result['error']}");
            }
        }

        $this->info('Sync run completed.');
        return 0;
    }
}
