<?php
namespace App\Domain\ValueObjects;

class DomainName
{
    private string $name;

    public function __construct(string $name)
    {
        if (!$this->isValid($name)) {
            throw new \InvalidArgumentException("Невірний формат доменного імені.");
        }
        $this->name = $name;
    }

    public function getTLD(): string
    {
        return substr(strrchr($this->name, "."), 1);
    }

    public function getSecondLevelDomain(): string
    {
        return explode('.', $this->name)[0];
    }

    private function isValid(string $domain): bool
    {
        return (bool) preg_match('/^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/i', $domain);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
