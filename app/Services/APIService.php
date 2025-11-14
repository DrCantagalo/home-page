<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class APIService
{
    public function registerinstallation(Request $request)
    {
        $lang = $request->lang;
        App::setLocale(session($lang,'en'));
        $hash = $request->installation_hash;
        $siteUrl = $request->site_url;
        $version = $request->package_version;
        $clientIp = $request->ip();
        $sanctumToken = $request->sanctum_token;

        $installation = Installation::where('installation_hash', $hash)->first();

        if ($installation) {
            return response()->json([
                'status' => 'success',
                'message' => __('We found your registration!'),
                'installation_code' => $installation->installation_code,
                'api_token' => Crypt::decrypt($installation->api_token_enc),
            ]);
        }

        $ipMatches = $this->checkIpMatchesUrl($clientIp, $siteUrl, $hash);

        if(!$ipMatches) {
            return response()->json([
                'status' => 'error',
                'message' => __("Domain ownership could not be verified automatically: IP address of the request does not match the resolved IPs for the provided domain and no DNS TXT record found. Add to your DNS a txt record with name as '@' and value as") . " 'monitor-verification={$hash}'" . __("After adding the DNS TXT record, try registering the installation again.")
            ], 422);
        }

        $apiToken = Str::random(64);
        $installationCode = strtoupper(Str::random(12));

        $installation = Installation::create([
            'installation_hash' => $hash,
            'site_url' => $siteUrl,
            'package_version' => $version,
            'client_ip' => $clientIp,
            'installation_code' => $installationCode,
            'api_token' => hash('sha256', $apiToken),
            'api_token_enc' => Crypt::encrypt($apiToken),
            'sanctum_token_enc' => Crypt::encrypt($sanctumToken),
            'sanctum_token_hash' => hash('sha256', $sanctumToken),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __("We've created a new registration for your installation."),
            'installation_code' => $installationCode,
            'api_token' => $apiToken,
        ]);
    }

    private function checkIpMatchesUrl(string $clientIp, string $url, string $hash): bool
    {
        $host = parse_url($url, PHP_URL_HOST);

        if (!$host) {
            return false;
        }

        $dnsRecords = dns_get_record($host, DNS_A | DNS_AAAA | DNS_TXT);

        if (!$dnsRecords) {
            return false;
        }

        $domainIps = [];
        $txtRecords = [];

        // Extrai IPs (IPv4 e IPv6) e registros TXT
        foreach ($dnsRecords as $record) {
            if (!empty($record['ip'])) {
                $domainIps[] = $record['ip'];
            } elseif (!empty($record['ipv6'])) {
                $domainIps[] = $record['ipv6'];
            } elseif (!empty($record['txt'])) {
                $txtRecords[] = trim($record['txt']);
            }
        }

        foreach ($domainIps as $ip) {
            if (@inet_pton($ip) === @inet_pton($clientIp)) {
                return true;
            }
        }

        foreach ($txtRecords as $txt) {
            if (str_contains($txt, $hash)) {
                return true;
            }
        }

        return false;
    }

}