<?php

namespace App\Application\Services;

use App\Domain\Repositories\WhoisRepositoryInterface;

class WhoisService
{
    public function __construct(private WhoisRepositoryInterface $whoisRepository) {}

    public function lookup(string $domain): ?string
    {
        $whoisServer = $this->getWhoisServerFromIANA($domain);

        if (!$whoisServer) {
            return "WHOIS-сервер не знайдено для $domain";
        }

        $whoisResponse = $this->queryWhoisServer($whoisServer, $domain);

        if ($whoisResponse) {
            $this->whoisRepository->save($domain, $whoisResponse);
        }

        return $whoisResponse;
    }

    private function getWhoisServerFromIANA(string $domain): ?string
    {
        $tld = substr(strrchr($domain, "."), 1);
        $ianaResponse = $this->queryWhoisServer('whois.iana.org', $tld);

        if (!$ianaResponse) {
            return null;
        }

        if (preg_match('/whois:\s*([^\s]+)/i', $ianaResponse, $match)) {
            return trim($match[1]);
        }

        return null;
    }

    private function queryWhoisServer(string $server, string $query): ?string
    {
        $sock = @fsockopen($server, 43, $errno, $errstr, 10);
        if (!$sock) {
            return null;
        }

        fwrite($sock, "$query\r\n");
        $response = "";

        while (!feof($sock)) {
            $response .= fgets($sock, 1024);
        }

        fclose($sock);
        return trim($response);
    }
}
