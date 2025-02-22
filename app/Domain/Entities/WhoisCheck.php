<?php
namespace App\Domain\Entities;

class WhoisCheck
{
    public function __construct(
        public int $id,
        public string $domain,
        public array $whoisData,
        public string $ip,
        public \DateTime $checkedAt
    ) {}
}
