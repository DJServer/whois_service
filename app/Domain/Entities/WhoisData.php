<?php
namespace App\Domain\Entities;

class WhoisData
{
    public function __construct(
        public string $domain,
        public string $registrar,
        public \DateTime $createdAt,
        public \DateTime $expiresAt,
        public string $owner,
        public array $nameServers,
        public string $fullResponse,
    ) {}
}
