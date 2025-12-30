<?php

declare(strict_types=1);

namespace MizbanCloud\Tests;

use PHPUnit\Framework\TestCase;
use MizbanCloud\MizbanCloud;
use MizbanCloud\Modules\Cdn;

class CdnTest extends TestCase
{
    private MizbanCloud $client;

    protected function setUp(): void
    {
        $this->client = new MizbanCloud([
            'baseUrl' => 'https://auth.mizbancloud.com',
        ]);
    }

    public function testCdnModuleExists(): void
    {
        $this->assertNotNull($this->client->cdn);
        $this->assertInstanceOf(Cdn::class, $this->client->cdn);
    }

    // ==================== Domain Methods ====================

    public function testListDomainsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'listDomains'));
    }

    public function testGetDomainMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getDomain'));
    }

    public function testAddDomainMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'addDomain'));
    }

    public function testDeleteDomainMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'deleteDomain'));
    }

    public function testSendDeleteConfirmCodeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'sendDeleteConfirmCode'));
    }

    public function testGetUsageMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getUsage'));
    }

    public function testGetWhoisMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getWhois'));
    }

    public function testGetReportsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getReports'));
    }

    public function testSetRedirectModeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setRedirectMode'));
    }

    // ==================== DNS Methods ====================

    public function testListDnsRecordsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'listDnsRecords'));
    }

    public function testGetDnsRecordMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getDnsRecord'));
    }

    public function testAddDnsRecordMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'addDnsRecord'));
    }

    public function testUpdateDnsRecordMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'updateDnsRecord'));
    }

    public function testDeleteDnsRecordMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'deleteDnsRecord'));
    }

    public function testFetchRecordsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'fetchRecords'));
    }

    public function testExportDnsRecordsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'exportDnsRecords'));
    }

    public function testImportDnsRecordsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'importDnsRecords'));
    }

    public function testGetProxiableRecordsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getProxiableRecords'));
    }

    public function testSetCustomNameserversMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCustomNameservers'));
    }

    public function testSetDnssecMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setDnssec'));
    }

    // ==================== SSL Methods ====================

    public function testListSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'listSsl'));
    }

    public function testGetSslInfoMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getSslInfo'));
    }

    public function testGetSslConfigsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getSslConfigs'));
    }

    public function testAddCustomSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'addCustomSsl'));
    }

    public function testRequestFreeSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'requestFreeSsl'));
    }

    public function testRemoveSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'removeSsl'));
    }

    public function testAttachSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'attachSsl'));
    }

    public function testDetachSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'detachSsl'));
    }

    public function testAttachDefaultSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'attachDefaultSsl'));
    }

    public function testDetachDefaultSslMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'detachDefaultSsl'));
    }

    public function testSetTlsVersionMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setTlsVersion'));
    }

    public function testSetHstsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setHsts'));
    }

    public function testSetHttpsRedirectMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setHttpsRedirect'));
    }

    public function testSetCspOverrideMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCspOverride'));
    }

    public function testSetBackendProtocolMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setBackendProtocol'));
    }

    public function testSetHttp3MethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setHttp3'));
    }

    // ==================== Cache Methods ====================

    public function testGetCacheSettingsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getCacheSettings'));
    }

    public function testSetCacheModeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCacheMode'));
    }

    public function testSetCacheTtlMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCacheTtl'));
    }

    public function testSetDeveloperModeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setDeveloperMode'));
    }

    public function testSetAlwaysOnlineMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setAlwaysOnline'));
    }

    public function testSetCacheCookiesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCacheCookies'));
    }

    public function testSetBrowserCacheModeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setBrowserCacheMode'));
    }

    public function testSetBrowserCacheTtlMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setBrowserCacheTtl'));
    }

    public function testSetErrorCacheTtlMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setErrorCacheTtl'));
    }

    public function testPurgeCacheMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'purgeCache'));
    }

    // ==================== Acceleration Methods ====================

    public function testSetMinifyMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setMinify'));
    }

    public function testSetImageOptimizationMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setImageOptimization'));
    }

    public function testSetImageResizeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setImageResize'));
    }

    // ==================== DDoS Methods ====================

    public function testGetDdosSettingsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getDdosSettings'));
    }

    public function testSetDdosSettingsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setDdosSettings'));
    }

    public function testSetCaptchaModuleMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCaptchaModule'));
    }

    public function testSetCaptchaTtlMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCaptchaTtl'));
    }

    public function testSetCookieChallengeTtlMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCookieChallengeTtl'));
    }

    public function testSetJsChallengeTtlMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setJsChallengeTtl'));
    }

    // ==================== Firewall Methods ====================

    public function testGetFirewallConfigsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getFirewallConfigs'));
    }

    public function testSetFirewallConfigsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setFirewallConfigs'));
    }

    // ==================== WAF Methods ====================

    public function testGetWafSettingsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getWafSettings'));
    }

    public function testSetWafSettingsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setWafSettings'));
    }

    public function testGetWafLayersMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getWafLayers'));
    }

    public function testGetWafRulesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getWafRules'));
    }

    public function testGetDisabledWafRulesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getDisabledWafRules'));
    }

    public function testSwitchWafGroupMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'switchWafGroup'));
    }

    public function testSwitchWafRuleMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'switchWafRule'));
    }

    // ==================== Page Rules Methods ====================

    public function testGetPageRulesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getPageRules'));
    }

    public function testGetPageRulesWafMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getPageRulesWaf'));
    }

    public function testGetPageRulesRatelimitMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getPageRulesRatelimit'));
    }

    public function testGetPageRulesDdosMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getPageRulesDdos'));
    }

    public function testGetPageRulesFirewallMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getPageRulesFirewall'));
    }

    public function testCreatePageRulePathMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'createPageRulePath'));
    }

    public function testSetPageRulePriorityMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setPageRulePriority'));
    }

    public function testDeletePageRulePathMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'deletePageRulePath'));
    }

    public function testCreateRuleMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'createRule'));
    }

    public function testDeleteRuleMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'deleteRule'));
    }

    public function testSetDirectRuleMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setDirectRule'));
    }

    // ==================== Cluster Methods ====================

    public function testGetClustersMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getClusters'));
    }

    public function testGetClusterAssignmentsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getClusterAssignments'));
    }

    public function testAddClusterMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'addCluster'));
    }

    public function testUpdateClusterMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'updateCluster'));
    }

    public function testDeleteClusterMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'deleteCluster'));
    }

    public function testAddServerToClusterMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'addServerToCluster'));
    }

    public function testRemoveServerFromClusterMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'removeServerFromCluster'));
    }

    // ==================== Log Forwarder Methods ====================

    public function testGetLogForwardersMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getLogForwarders'));
    }

    public function testAddLogForwarderMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'addLogForwarder'));
    }

    public function testUpdateLogForwarderMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'updateLogForwarder'));
    }

    public function testDeleteLogForwarderMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'deleteLogForwarder'));
    }

    // ==================== Custom Pages Methods ====================

    public function testGetCustomPagesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getCustomPages'));
    }

    public function testSetCustomPagesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'setCustomPages'));
    }

    public function testDeleteCustomPagesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'deleteCustomPages'));
    }

    // ==================== Plan Methods ====================

    public function testGetPlansMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'getPlans'));
    }

    public function testChangePlanMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cdn, 'changePlan'));
    }

    // ==================== Method Count Test ====================

    public function testCdnModuleMethodCount(): void
    {
        $reflection = new \ReflectionClass($this->client->cdn);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        // Filter out constructor
        $publicMethods = array_filter($methods, fn($m) => $m->getName() !== '__construct');

        // CDN module should have ~80 methods
        $this->assertGreaterThanOrEqual(70, count($publicMethods));
    }
}
