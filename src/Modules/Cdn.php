<?php

declare(strict_types=1);

namespace MizbanCloud\Modules;

use MizbanCloud\HttpClient;

/**
 * CDN Module
 *
 * Complete CDN management: domains, DNS, SSL, cache, security, page rules, clusters.
 */
class Cdn
{
    public function __construct(
        private readonly HttpClient $client
    ) {}

    // ==================== Domains ====================

    /**
     * List all domains
     */
    public function listDomains(): array
    {
        return $this->client->get('/api/v1/cdn/ng/domains');
    }

    /**
     * Get domain details
     */
    public function getDomain(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}");
    }

    /**
     * Add a new domain
     */
    public function addDomain(array $data): array
    {
        return $this->client->post('/api/v1/cdn/ng/domains', $data);
    }

    /**
     * Delete a domain (requires confirmation code)
     */
    public function deleteDomain(int $domainId, string $confirmCode): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}", [
            'confirm_code' => $confirmCode,
        ]);
    }

    /**
     * Send delete confirmation code via SMS
     */
    public function sendDeleteConfirmCode(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/send-confirm-code");
    }

    /**
     * Get domain usage/analytics
     */
    public function getUsage(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/usage");
    }

    /**
     * Get domain WHOIS data
     */
    public function getWhois(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/whois");
    }

    /**
     * Get domain reports/analytics
     */
    public function getReports(int $domainId, array $data = []): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/reports", $data);
    }

    /**
     * Set redirect mode (www to non-www or vice versa)
     */
    public function setRedirectMode(int $domainId, string $mode): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/redirect-mode", [
            'mode' => $mode,
        ]);
    }

    // ==================== DNS ====================

    /**
     * List DNS records
     */
    public function listDnsRecords(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/dns");
    }

    /**
     * Get a specific DNS record
     */
    public function getDnsRecord(int $domainId, int $recordId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/dns/{$recordId}");
    }

    /**
     * Add a DNS record
     */
    public function addDnsRecord(int $domainId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/dns", $data);
    }

    /**
     * Update a DNS record
     */
    public function updateDnsRecord(int $domainId, int $recordId, array $data): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/dns/{$recordId}", $data);
    }

    /**
     * Delete a DNS record
     */
    public function deleteDnsRecord(int $domainId, int $recordId): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/dns/{$recordId}");
    }

    /**
     * Auto-import DNS records from registrar
     */
    public function fetchRecords(int $domainId): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/dns/fetch-records");
    }

    /**
     * Export DNS records (BIND format)
     */
    public function exportDnsRecords(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/dns/export");
    }

    /**
     * Import DNS records from BIND file
     */
    public function importDnsRecords(int $domainId, string $records): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/dns/import", [
            'file' => $records,
        ]);
    }

    /**
     * Get proxiable records (including trashed)
     */
    public function getProxiableRecords(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/dns/proxiable");
    }

    /**
     * Set custom nameservers
     */
    public function setCustomNameservers(int $domainId, array $nameservers): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/dns/custom-ns", [
            'nameservers' => $nameservers,
        ]);
    }

    /**
     * Enable/disable DNSSEC
     */
    public function setDnssec(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/dns/dnssec", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    // ==================== SSL/HTTPS ====================

    /**
     * List SSL certificates
     */
    public function listSsl(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/https/ssl");
    }

    /**
     * Get SSL info (current active certificate)
     */
    public function getSslInfo(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/https/ssl/get-info");
    }

    /**
     * Get SSL configurations
     */
    public function getSslConfigs(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/https/ssl/get-configs");
    }

    /**
     * Add custom SSL certificate
     */
    public function addCustomSsl(int $domainId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/ssl/add", $data);
    }

    /**
     * Request free SSL certificate (Let's Encrypt)
     */
    public function requestFreeSsl(int $domainId): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/ssl/free");
    }

    /**
     * Remove SSL certificate
     */
    public function removeSsl(int $domainId, int $sslId): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/https/ssl/{$sslId}");
    }

    /**
     * Attach SSL certificate to domain
     */
    public function attachSsl(int $domainId, int $sslId): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/attach", [
            'ssl_id' => $sslId,
        ]);
    }

    /**
     * Detach SSL certificate from domain
     */
    public function detachSsl(int $domainId): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/detach");
    }

    /**
     * Attach default (shared) SSL
     */
    public function attachDefaultSsl(int $domainId): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/attach-default");
    }

    /**
     * Detach default SSL
     */
    public function detachDefaultSsl(int $domainId): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/detach-default");
    }

    /**
     * Set minimum TLS version
     */
    public function setTlsVersion(int $domainId, string $version): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/ssl/tls-version", [
            'version' => $version,
        ]);
    }

    /**
     * Configure HSTS
     */
    public function setHsts(int $domainId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/hsts", $data);
    }

    /**
     * Enable/disable HTTPS redirect
     */
    public function setHttpsRedirect(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/redirect", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    /**
     * Set Content Security Policy override
     */
    public function setCspOverride(int $domainId, string $csp): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/csp-override", [
            'csp' => $csp,
        ]);
    }

    /**
     * Set backend protocol (origin)
     */
    public function setBackendProtocol(int $domainId, string $protocol): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/backend-protocol", [
            'protocol' => $protocol,
        ]);
    }

    /**
     * Enable/disable HTTP/3
     */
    public function setHttp3(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/https/h3", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    // ==================== Cache ====================

    /**
     * Get cache settings
     */
    public function getCacheSettings(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/cache");
    }

    /**
     * Set cache mode
     */
    public function setCacheMode(int $domainId, string $mode): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/edge/change-mode", [
            'mode' => $mode,
        ]);
    }

    /**
     * Set cache TTL
     */
    public function setCacheTtl(int $domainId, int $ttl): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/edge/change-ttl", [
            'ttl' => $ttl,
        ]);
    }

    /**
     * Enable/disable developer mode (bypass cache)
     */
    public function setDeveloperMode(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/edge/developer-mode", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    /**
     * Enable/disable always online mode
     */
    public function setAlwaysOnline(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/edge/always-online", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    /**
     * Enable/disable cookie caching
     */
    public function setCacheCookies(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/edge/cache-cookies", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    /**
     * Set browser cache mode
     */
    public function setBrowserCacheMode(int $domainId, string $mode): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/browser/change-mode", [
            'mode' => $mode,
        ]);
    }

    /**
     * Set browser cache TTL
     */
    public function setBrowserCacheTtl(int $domainId, int $ttl): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/browser/change-ttl", [
            'ttl' => $ttl,
        ]);
    }

    /**
     * Set error response cache TTL
     */
    public function setErrorCacheTtl(int $domainId, int $ttl): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/errors/cache-ttl", [
            'ttl' => $ttl,
        ]);
    }

    /**
     * Purge cache
     */
    public function purgeCache(int $domainId, array $data = []): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cache/edge/purge-cache", [
            'purge_all' => ($data['purge_all'] ?? false) ? 1 : 0,
            'urls' => $data['urls'] ?? null,
            'tags' => $data['tags'] ?? null,
            'prefixes' => $data['prefixes'] ?? null,
        ]);
    }

    // ==================== Acceleration ====================

    /**
     * Set minification settings
     */
    public function setMinify(int $domainId, array $settings): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/acceleration/assets/minify", [
            'html' => ($settings['html'] ?? false) ? 1 : 0,
            'css' => ($settings['css'] ?? false) ? 1 : 0,
            'js' => ($settings['js'] ?? false) ? 1 : 0,
        ]);
    }

    /**
     * Enable/disable image optimization (WebP conversion)
     */
    public function setImageOptimization(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/acceleration/images/optimize", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    /**
     * Enable/disable image resize
     */
    public function setImageResize(int $domainId, bool $enabled): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/acceleration/images/resize", [
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    // ==================== DDoS Protection ====================

    /**
     * Get DDoS protection settings
     */
    public function getDdosSettings(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/ddos");
    }

    /**
     * Set DDoS protection settings
     */
    public function setDdosSettings(int $domainId, array $settings): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/ddos", $settings);
    }

    /**
     * Set captcha module
     */
    public function setCaptchaModule(int $domainId, string $module): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/ddos/captcha-module", [
            'module' => $module,
        ]);
    }

    /**
     * Set captcha challenge TTL
     */
    public function setCaptchaTtl(int $domainId, int $ttl): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/ddos/set-ttl/captcha", [
            'ttl' => $ttl,
        ]);
    }

    /**
     * Set cookie challenge TTL
     */
    public function setCookieChallengeTtl(int $domainId, int $ttl): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/ddos/set-ttl/cookie", [
            'ttl' => $ttl,
        ]);
    }

    /**
     * Set JS challenge TTL
     */
    public function setJsChallengeTtl(int $domainId, int $ttl): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/ddos/set-ttl/js", [
            'ttl' => $ttl,
        ]);
    }

    // ==================== Firewall ====================

    /**
     * Get firewall configs
     */
    public function getFirewallConfigs(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/firewall");
    }

    /**
     * Set firewall configs
     */
    public function setFirewallConfigs(int $domainId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/firewall", $data);
    }

    // ==================== WAF ====================

    /**
     * Get WAF settings
     */
    public function getWafSettings(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/waf");
    }

    /**
     * Set WAF settings
     */
    public function setWafSettings(int $domainId, array $settings): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/waf", $settings);
    }

    /**
     * Get WAF layers (rulesets)
     */
    public function getWafLayers(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/waf/layers");
    }

    /**
     * Get WAF rules list
     */
    public function getWafRules(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/waf/rules");
    }

    /**
     * Get disabled WAF rules
     */
    public function getDisabledWafRules(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/waf/disabled-rules");
    }

    /**
     * Enable/disable WAF rule group
     */
    public function switchWafGroup(int $domainId, string $groupId, bool $enabled): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/waf/switch-group", [
            'group_id' => $groupId,
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    /**
     * Enable/disable individual WAF rule
     */
    public function switchWafRule(int $domainId, string $ruleId, bool $enabled): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/waf/switch-rule", [
            'rule_id' => $ruleId,
            'enabled' => $enabled ? 1 : 0,
        ]);
    }

    // ==================== Page Rules ====================

    /**
     * Get all page rules
     */
    public function getPageRules(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/paths");
    }

    /**
     * Get page rules for WAF section
     */
    public function getPageRulesWaf(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/paths/waf");
    }

    /**
     * Get page rules for Rate Limit section
     */
    public function getPageRulesRatelimit(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/paths/ratelimit");
    }

    /**
     * Get page rules for DDoS section
     */
    public function getPageRulesDdos(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/paths/ddos");
    }

    /**
     * Get page rules for Firewall section
     */
    public function getPageRulesFirewall(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/paths/firewall");
    }

    /**
     * Create a page rule path
     */
    public function createPageRulePath(int $domainId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/paths", $data);
    }

    /**
     * Update page rule priority
     */
    public function setPageRulePriority(int $domainId, int $pathId, int $priority): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/paths/{$pathId}", [
            'priority' => $priority,
        ]);
    }

    /**
     * Delete a page rule path
     */
    public function deletePageRulePath(int $domainId, int $pathId): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/paths/{$pathId}");
    }

    /**
     * Create/set rule for a page rule path
     */
    public function createRule(int $domainId, int $pathId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/paths/{$pathId}/rules", $data);
    }

    /**
     * Delete rule from a page rule path
     */
    public function deleteRule(int $domainId, int $pathId, string $ruleType): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/paths/{$pathId}/rules/{$ruleType}");
    }

    /**
     * Set rule directly (without path)
     */
    public function setDirectRule(int $domainId, string $section, array $settings): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/paths/direct-rule/{$section}", $settings);
    }

    // ==================== Clusters (Load Balancing) ====================

    /**
     * Get clusters (origin pools)
     */
    public function getClusters(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/cluster");
    }

    /**
     * Get cluster assignments (which paths use which clusters)
     */
    public function getClusterAssignments(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/cluster/assignments");
    }

    /**
     * Add a cluster
     */
    public function addCluster(int $domainId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cluster", $data);
    }

    /**
     * Update a cluster
     */
    public function updateCluster(int $domainId, int $clusterId, array $data): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/cluster/{$clusterId}", $data);
    }

    /**
     * Delete a cluster
     */
    public function deleteCluster(int $domainId, int $clusterId): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/cluster/{$clusterId}");
    }

    /**
     * Add server to cluster
     */
    public function addServerToCluster(int $domainId, int $clusterId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/cluster/{$clusterId}/servers", $data);
    }

    /**
     * Remove server from cluster
     */
    public function removeServerFromCluster(int $domainId, int $clusterId, int $serverId): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/cluster/{$clusterId}/servers/{$serverId}");
    }

    // ==================== Log Forwarders ====================

    /**
     * Get log forwarders
     */
    public function getLogForwarders(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/log-forwarders");
    }

    /**
     * Add log forwarder
     */
    public function addLogForwarder(int $domainId, array $data): array
    {
        return $this->client->post("/api/v1/cdn/ng/domains/{$domainId}/log-forwarders", $data);
    }

    /**
     * Update log forwarder
     */
    public function updateLogForwarder(int $domainId, int $loggerId, array $data): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/log-forwarders/{$loggerId}", $data);
    }

    /**
     * Delete log forwarder
     */
    public function deleteLogForwarder(int $domainId, int $loggerId): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/log-forwarders/{$loggerId}");
    }

    // ==================== Custom Pages ====================

    /**
     * Get custom error pages
     */
    public function getCustomPages(int $domainId): array
    {
        return $this->client->get("/api/v1/cdn/ng/domains/{$domainId}/custom-pages");
    }

    /**
     * Set custom error pages
     */
    public function setCustomPages(int $domainId, array $pages): array
    {
        return $this->client->put("/api/v1/cdn/ng/domains/{$domainId}/custom-pages", $pages);
    }

    /**
     * Delete custom pages (reset to default)
     */
    public function deleteCustomPages(int $domainId): array
    {
        return $this->client->delete("/api/v1/cdn/ng/domains/{$domainId}/custom-pages");
    }

    // ==================== Plans ====================

    /**
     * Get available CDN plans
     */
    public function getPlans(?int $domainId = null): array
    {
        $data = $domainId ? ['domain_id' => $domainId] : [];
        return $this->client->get('/api/v1/cdn/ng/plans', $data);
    }

    /**
     * Change domain plan
     */
    public function changePlan(int $domainId, int $planId): array
    {
        return $this->client->post('/api/v1/cdn/ng/plans', [
            'domain_id' => $domainId,
            'plan_id' => $planId,
        ]);
    }
}
