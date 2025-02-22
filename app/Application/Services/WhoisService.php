<?php
namespace App\Application\Services;

class WhoisService
{
    public function lookup(string $domain): ?string
    {
        $whoisServer = $this->getWhoisServerFromIANA($domain);

        if (!$whoisServer) {
            return "WHOIS-сервер не знайдено для $domain";
        }

        return $this->queryWhoisServer($whoisServer, $domain);
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
