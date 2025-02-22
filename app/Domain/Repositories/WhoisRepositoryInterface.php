<?php
namespace App\Domain\Repositories;

interface WhoisRepositoryInterface
{
    /**
     * @param string $domain
     * @return string|null
     */
    public function findByDomain(string $domain): ?string;

    /**
     * @param string $domain
     * @param string $whoisData
     * @return void
     */
    public function save(string $domain, string $whoisData): void;
}
