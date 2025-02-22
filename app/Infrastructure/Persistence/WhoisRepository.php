<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\WhoisRepositoryInterface;
use App\Models\WhoisCheck;

class WhoisRepository implements WhoisRepositoryInterface
{
    public function findByDomain(string $domain): ?string
    {
        $check = WhoisCheck::where('domain', $domain)->first();
        return $check ? $check->whois_data : null;
    }

    public function save(string $domain, string $whoisData): void
    {
        WhoisCheck::updateOrCreate(
            ['domain' => $domain],
            ['whois_data' => $whoisData]
        );
    }
}
