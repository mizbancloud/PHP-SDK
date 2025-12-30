<?php

declare(strict_types=1);

namespace MizbanCloud\Modules;

use MizbanCloud\HttpClient;

/**
 * Cloud Module
 *
 * Complete IaaS management: servers, firewall, networks, volumes, snapshots, SSH keys.
 */
class Cloud
{
    public function __construct(
        private readonly HttpClient $client
    ) {}

    // ==================== Servers ====================

    /**
     * List all servers
     */
    public function listServers(): array
    {
        return $this->client->get('/api/v1/cloud/servers');
    }

    /**
     * Get server details
     */
    public function getServer(int $serverId): array
    {
        return $this->client->get("/api/v1/cloud/servers/{$serverId}");
    }

    /**
     * Long poll for server status changes
     */
    public function pollServer(int $serverId): array
    {
        return $this->client->get("/api/v1/cloud/servers/{$serverId}/poll");
    }

    /**
     * Create a new server
     */
    public function createServer(array $data): array
    {
        return $this->client->post('/api/v1/cloud/servers', $data);
    }

    /**
     * Delete a server
     */
    public function deleteServer(int $serverId): array
    {
        return $this->client->delete("/api/v1/cloud/servers/{$serverId}");
    }

    /**
     * Rename a server
     */
    public function renameServer(int $serverId, string $name): array
    {
        return $this->client->post("/api/v1/cloud/servers/{$serverId}/rename", [
            'name' => $name,
        ]);
    }

    /**
     * Resize server (change CPU/RAM)
     */
    public function resizeServer(int $serverId, array $data): array
    {
        return $this->client->put("/api/v1/cloud/servers/{$serverId}/rebuild/hardware", $data);
    }

    /**
     * Reload OS (reinstall)
     */
    public function reloadOs(int $serverId, array $data): array
    {
        return $this->client->put("/api/v1/cloud/servers/{$serverId}/rebuild/software", $data);
    }

    // ==================== Power Management ====================

    /**
     * Power on server
     */
    public function powerOn(int $serverId): array
    {
        return $this->client->put("/api/v1/cloud/servers/{$serverId}/power/on");
    }

    /**
     * Power off server (hard)
     */
    public function powerOff(int $serverId): array
    {
        return $this->client->put("/api/v1/cloud/servers/{$serverId}/power/off");
    }

    /**
     * Reboot server (hard reboot)
     */
    public function reboot(int $serverId): array
    {
        return $this->client->put("/api/v1/cloud/servers/{$serverId}/power/reboot");
    }

    /**
     * Restart server (soft/graceful reboot)
     */
    public function restart(int $serverId): array
    {
        return $this->client->put("/api/v1/cloud/servers/{$serverId}/power/restart");
    }

    // ==================== Access ====================

    /**
     * Get VNC console access
     */
    public function getVnc(int $serverId): array
    {
        return $this->client->get("/api/v1/cloud/servers/{$serverId}/access/vnc");
    }

    /**
     * Reset root password
     */
    public function resetPassword(int $serverId, array $data): array
    {
        return $this->client->put("/api/v1/cloud/servers/{$serverId}/reset-password", $data);
    }

    /**
     * Get initial password (for newly created servers)
     */
    public function getInitialPassword(int $serverId): array
    {
        return $this->client->post("/api/v1/cloud/servers/{$serverId}/get-password");
    }

    // ==================== Rescue Mode ====================

    /**
     * Boot into rescue mode
     */
    public function rescue(int $serverId, array $data): array
    {
        return $this->client->post("/api/v1/cloud/servers/{$serverId}/rescue", $data);
    }

    /**
     * Exit rescue mode
     */
    public function unrescue(int $serverId): array
    {
        return $this->client->post("/api/v1/cloud/servers/{$serverId}/unrescue");
    }

    // ==================== Autopilot (High Availability) ====================

    /**
     * Enable autopilot (HA)
     */
    public function enableAutopilot(int $serverId): array
    {
        return $this->client->post("/api/v1/cloud/servers/{$serverId}/autopilot/enable");
    }

    /**
     * Disable autopilot (HA)
     */
    public function disableAutopilot(int $serverId): array
    {
        return $this->client->delete("/api/v1/cloud/servers/{$serverId}/autopilot/disable");
    }

    // ==================== Monitoring ====================

    /**
     * Get server action logs
     */
    public function getLogs(int $serverId): array
    {
        return $this->client->get("/api/v1/cloud/servers/{$serverId}/logs");
    }

    /**
     * Get server metrics/charts
     */
    public function getCharts(int $serverId, array $data): array
    {
        return $this->client->get("/api/v1/cloud/servers/{$serverId}/reports", $data);
    }

    /**
     * Get traffic usage for all servers
     */
    public function getTrafficUsage(): array
    {
        return $this->client->get('/api/v1/cloud/servers/traffics');
    }

    /**
     * Get traffic usage (alternate endpoint)
     */
    public function getTraffics(): array
    {
        return $this->client->get('/api/v1/cloud/traffics');
    }

    // ==================== Test Servers ====================

    /**
     * Convert test server to permanent
     */
    public function convertToPermanent(int $serverId): array
    {
        return $this->client->post("/api/v1/cloud/servers/{$serverId}/permenant");
    }

    // ==================== Firewall / Security Groups ====================

    /**
     * List security groups
     */
    public function listSecurityGroups(): array
    {
        return $this->client->get('/api/v1/cloud/firewall');
    }

    /**
     * Create security group
     */
    public function createSecurityGroup(array $data): array
    {
        return $this->client->post('/api/v1/cloud/firewall', $data);
    }

    /**
     * Delete security group
     */
    public function deleteSecurityGroup(int $firewallId): array
    {
        return $this->client->delete("/api/v1/cloud/firewall/{$firewallId}");
    }

    /**
     * Add security rule
     */
    public function addSecurityRule(array $data): array
    {
        return $this->client->post('/api/v1/cloud/firewall/rule', $data);
    }

    /**
     * Remove security rule
     */
    public function removeSecurityRule(int $ruleId): array
    {
        return $this->client->delete("/api/v1/cloud/firewall/rule/{$ruleId}");
    }

    /**
     * Attach firewall to server
     */
    public function attachFirewall(array $data): array
    {
        return $this->client->post('/api/v1/cloud/firewall/attach', $data);
    }

    /**
     * Detach firewall from server
     */
    public function detachFirewall(array $data): array
    {
        return $this->client->post('/api/v1/cloud/firewall/detach', $data);
    }

    // ==================== Private Networks ====================

    /**
     * List private networks
     */
    public function listPrivateNetworks(): array
    {
        return $this->client->get('/api/v1/cloud/private-networks');
    }

    /**
     * Create private network
     */
    public function createPrivateNetwork(array $data): array
    {
        return $this->client->post('/api/v1/cloud/private-networks', $data);
    }

    /**
     * Update private network
     */
    public function updatePrivateNetwork(int $networkId, array $data): array
    {
        return $this->client->put("/api/v1/cloud/private-networks/{$networkId}", $data);
    }

    /**
     * Delete private network
     */
    public function deletePrivateNetwork(int $networkId): array
    {
        return $this->client->delete("/api/v1/cloud/private-networks/{$networkId}");
    }

    /**
     * Attach server to private network
     */
    public function attachToPrivateNetwork(array $data): array
    {
        return $this->client->post('/api/v1/cloud/private-networks/attach', $data);
    }

    /**
     * Detach server from private network
     */
    public function detachFromPrivateNetwork(array $data): array
    {
        return $this->client->post('/api/v1/cloud/private-networks/detach', $data);
    }

    /**
     * Purge all attachments from a network
     */
    public function purgeNetworkAttachments(int $networkId): array
    {
        return $this->client->post("/api/v1/cloud/private-networks/{$networkId}/purge-attachments");
    }

    // ==================== Public Networks ====================

    /**
     * Attach public network to server
     */
    public function attachPublicNetwork(int $serverId): array
    {
        return $this->client->post('/api/v1/cloud/public-networks/attach', [
            'server_id' => $serverId,
        ]);
    }

    /**
     * Detach public network from server
     */
    public function detachPublicNetwork(int $serverId): array
    {
        return $this->client->post('/api/v1/cloud/public-networks/detach', [
            'server_id' => $serverId,
        ]);
    }

    // ==================== Volumes ====================

    /**
     * List volumes
     */
    public function listVolumes(): array
    {
        return $this->client->get('/api/v1/cloud/volumes');
    }

    /**
     * Get volume details
     */
    public function getVolume(int $volumeId): array
    {
        return $this->client->get("/api/v1/cloud/volumes/{$volumeId}");
    }

    /**
     * Create volume
     */
    public function createVolume(array $data): array
    {
        return $this->client->post('/api/v1/cloud/volumes', $data);
    }

    /**
     * Update/resize volume
     */
    public function updateVolume(int $volumeId, array $data): array
    {
        return $this->client->put("/api/v1/cloud/volumes/{$volumeId}", $data);
    }

    /**
     * Delete volume
     */
    public function deleteVolume(int $volumeId): array
    {
        return $this->client->delete("/api/v1/cloud/volumes/{$volumeId}");
    }

    /**
     * Attach volume to server
     */
    public function attachVolume(array $data): array
    {
        return $this->client->post('/api/v1/cloud/volumes/attach', $data);
    }

    /**
     * Detach volume from server
     */
    public function detachVolume(int $volumeId): array
    {
        return $this->client->post('/api/v1/cloud/volumes/detach', [
            'volume_id' => $volumeId,
        ]);
    }

    /**
     * Sync volumes with OpenStack
     */
    public function syncVolumes(): array
    {
        return $this->client->post('/api/v1/cloud/volumes/sync');
    }

    // ==================== Snapshots ====================

    /**
     * List snapshots
     */
    public function listSnapshots(): array
    {
        return $this->client->get('/api/v1/cloud/snapshots');
    }

    /**
     * Get snapshot details
     */
    public function getSnapshot(int $snapshotId): array
    {
        return $this->client->get("/api/v1/cloud/snapshots/{$snapshotId}");
    }

    /**
     * Create snapshot
     */
    public function createSnapshot(array $data): array
    {
        return $this->client->post('/api/v1/cloud/snapshots', $data);
    }

    /**
     * Delete snapshot
     */
    public function deleteSnapshot(int $snapshotId): array
    {
        return $this->client->delete("/api/v1/cloud/snapshots/{$snapshotId}");
    }

    /**
     * Sync snapshots with OpenStack
     */
    public function syncSnapshots(): array
    {
        return $this->client->post('/api/v1/cloud/snapshots/sync');
    }

    // ==================== SSH Keys ====================

    /**
     * List SSH keys
     */
    public function listSshKeys(): array
    {
        return $this->client->get('/api/v1/cloud/ssh');
    }

    /**
     * Get SSH key details
     */
    public function getSshKey(int $keyId): array
    {
        return $this->client->get("/api/v1/cloud/ssh/{$keyId}");
    }

    /**
     * Create SSH key
     */
    public function createSshKey(array $data): array
    {
        return $this->client->post('/api/v1/cloud/ssh', $data);
    }

    /**
     * Delete SSH key
     */
    public function deleteSshKey(int $keyId): array
    {
        return $this->client->delete("/api/v1/cloud/ssh/{$keyId}");
    }

    /**
     * Generate random SSH key pair
     */
    public function generateRandomSshKey(): array
    {
        return $this->client->get('/api/v1/cloud/ssh/random');
    }
}
