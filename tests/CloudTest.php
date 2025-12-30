<?php

declare(strict_types=1);

namespace MizbanCloud\Tests;

use PHPUnit\Framework\TestCase;
use MizbanCloud\MizbanCloud;
use MizbanCloud\Modules\Cloud;

class CloudTest extends TestCase
{
    private MizbanCloud $client;

    protected function setUp(): void
    {
        $this->client = new MizbanCloud([
            'baseUrl' => 'https://auth.mizbancloud.com',
        ]);
    }

    public function testCloudModuleExists(): void
    {
        $this->assertNotNull($this->client->cloud);
        $this->assertInstanceOf(Cloud::class, $this->client->cloud);
    }

    // ==================== Server Methods ====================

    public function testListServersMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'listServers'));
    }

    public function testGetServerMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getServer'));
    }

    public function testPollServerMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'pollServer'));
    }

    public function testCreateServerMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'createServer'));
    }

    public function testDeleteServerMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'deleteServer'));
    }

    public function testRenameServerMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'renameServer'));
    }

    public function testResizeServerMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'resizeServer'));
    }

    public function testReloadOsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'reloadOs'));
    }

    // ==================== Power Management Methods ====================

    public function testPowerOnMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'powerOn'));
    }

    public function testPowerOffMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'powerOff'));
    }

    public function testRebootMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'reboot'));
    }

    public function testRestartMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'restart'));
    }

    // ==================== Access Methods ====================

    public function testGetVncMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getVnc'));
    }

    public function testResetPasswordMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'resetPassword'));
    }

    public function testGetInitialPasswordMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getInitialPassword'));
    }

    // ==================== Rescue Mode Methods ====================

    public function testRescueMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'rescue'));
    }

    public function testUnrescueMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'unrescue'));
    }

    // ==================== Autopilot Methods ====================

    public function testEnableAutopilotMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'enableAutopilot'));
    }

    public function testDisableAutopilotMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'disableAutopilot'));
    }

    // ==================== Monitoring Methods ====================

    public function testGetLogsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getLogs'));
    }

    public function testGetChartsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getCharts'));
    }

    public function testGetTrafficUsageMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getTrafficUsage'));
    }

    public function testGetTrafficsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getTraffics'));
    }

    // ==================== Test Server Methods ====================

    public function testConvertToPermanentMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'convertToPermanent'));
    }

    // ==================== Security Group Methods ====================

    public function testListSecurityGroupsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'listSecurityGroups'));
    }

    public function testCreateSecurityGroupMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'createSecurityGroup'));
    }

    public function testDeleteSecurityGroupMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'deleteSecurityGroup'));
    }

    public function testAddSecurityRuleMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'addSecurityRule'));
    }

    public function testRemoveSecurityRuleMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'removeSecurityRule'));
    }

    public function testAttachFirewallMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'attachFirewall'));
    }

    public function testDetachFirewallMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'detachFirewall'));
    }

    // ==================== Private Network Methods ====================

    public function testListPrivateNetworksMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'listPrivateNetworks'));
    }

    public function testCreatePrivateNetworkMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'createPrivateNetwork'));
    }

    public function testUpdatePrivateNetworkMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'updatePrivateNetwork'));
    }

    public function testDeletePrivateNetworkMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'deletePrivateNetwork'));
    }

    public function testAttachToPrivateNetworkMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'attachToPrivateNetwork'));
    }

    public function testDetachFromPrivateNetworkMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'detachFromPrivateNetwork'));
    }

    public function testPurgeNetworkAttachmentsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'purgeNetworkAttachments'));
    }

    // ==================== Public Network Methods ====================

    public function testAttachPublicNetworkMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'attachPublicNetwork'));
    }

    public function testDetachPublicNetworkMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'detachPublicNetwork'));
    }

    // ==================== Volume Methods ====================

    public function testListVolumesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'listVolumes'));
    }

    public function testGetVolumeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getVolume'));
    }

    public function testCreateVolumeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'createVolume'));
    }

    public function testUpdateVolumeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'updateVolume'));
    }

    public function testDeleteVolumeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'deleteVolume'));
    }

    public function testAttachVolumeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'attachVolume'));
    }

    public function testDetachVolumeMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'detachVolume'));
    }

    public function testSyncVolumesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'syncVolumes'));
    }

    // ==================== Snapshot Methods ====================

    public function testListSnapshotsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'listSnapshots'));
    }

    public function testGetSnapshotMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getSnapshot'));
    }

    public function testCreateSnapshotMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'createSnapshot'));
    }

    public function testDeleteSnapshotMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'deleteSnapshot'));
    }

    public function testSyncSnapshotsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'syncSnapshots'));
    }

    // ==================== SSH Key Methods ====================

    public function testListSshKeysMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'listSshKeys'));
    }

    public function testGetSshKeyMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'getSshKey'));
    }

    public function testCreateSshKeyMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'createSshKey'));
    }

    public function testDeleteSshKeyMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'deleteSshKey'));
    }

    public function testGenerateRandomSshKeyMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->cloud, 'generateRandomSshKey'));
    }

    // ==================== Method Count Test ====================

    public function testCloudModuleMethodCount(): void
    {
        $reflection = new \ReflectionClass($this->client->cloud);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        // Filter out constructor
        $publicMethods = array_filter($methods, fn($m) => $m->getName() !== '__construct');

        // Cloud module should have 58 methods
        $this->assertGreaterThanOrEqual(50, count($publicMethods));
    }
}
