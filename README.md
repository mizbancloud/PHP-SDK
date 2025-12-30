# MizbanCloud PHP SDK

Official PHP SDK for interacting with MizbanCloud CDN and Cloud APIs.

## Requirements

- PHP 8.0 or higher
- Composer

## Installation

```bash
composer require mizbancloud/sdk
```

## Quick Start

```php
<?php

require 'vendor/autoload.php';

use MizbanCloud\MizbanCloud;

// Create client instance
$client = new MizbanCloud([
    'baseUrl' => 'https://auth.mizbancloud.com',
]);

// Set API token
$client->setToken('your-api-token');

// List CDN domains
$domains = $client->cdn->listDomains();

// List cloud servers
$servers = $client->cloud->listServers();
```

## Configuration

```php
$client = new MizbanCloud([
    'baseUrl' => 'https://auth.mizbancloud.com', // API base URL
    'timeout' => 30,                              // Request timeout in seconds
    'language' => 'en',                           // Response language: 'en' or 'fa'
    'headers' => [],                              // Additional headers
]);
```

## Modules

### Auth Module

Token management and wallet operations.

```php
// Set API token
$client->auth->setApiToken('your-token');

// Get current token
$token = $client->auth->getApiToken();

// Clear token
$client->auth->clearApiToken();

// Get wallet balance
$wallet = $client->auth->getWallet();
```

### CDN Module

Complete CDN management: domains, DNS, SSL, cache, security, WAF, page rules, and more.

#### Domains

```php
// List all domains
$domains = $client->cdn->listDomains();

// Get domain details
$domain = $client->cdn->getDomain($domainId);

// Add a new domain
$result = $client->cdn->addDomain([
    'domain' => 'example.com',
]);

// Delete domain (requires SMS confirmation)
$client->cdn->sendDeleteConfirmCode($domainId);
$client->cdn->deleteDomain($domainId, $confirmCode);

// Get domain usage/analytics
$usage = $client->cdn->getUsage($domainId);

// Get domain reports
$reports = $client->cdn->getReports($domainId, [
    'from' => '2024-01-01',
    'to' => '2024-01-31',
]);
```

#### DNS Records

```php
// List DNS records
$records = $client->cdn->listDnsRecords($domainId);

// Add DNS record
$record = $client->cdn->addDnsRecord($domainId, [
    'type' => 'A',
    'name' => 'www',
    'value' => '1.2.3.4',
    'ttl' => 3600,
    'proxied' => true,
]);

// Update DNS record
$client->cdn->updateDnsRecord($domainId, $recordId, [
    'value' => '5.6.7.8',
]);

// Delete DNS record
$client->cdn->deleteDnsRecord($domainId, $recordId);

// Export DNS records (BIND format)
$export = $client->cdn->exportDnsRecords($domainId);

// Import DNS records
$client->cdn->importDnsRecords($domainId, $bindFileContent);

// Enable DNSSEC
$client->cdn->setDnssec($domainId, true);
```

#### SSL/HTTPS

```php
// List SSL certificates
$certs = $client->cdn->listSsl($domainId);

// Request free SSL (Let's Encrypt)
$client->cdn->requestFreeSsl($domainId);

// Add custom SSL certificate
$client->cdn->addCustomSsl($domainId, [
    'certificate' => '-----BEGIN CERTIFICATE-----...',
    'private_key' => '-----BEGIN PRIVATE KEY-----...',
]);

// Attach SSL to domain
$client->cdn->attachSsl($domainId, $sslId);

// Configure HSTS
$client->cdn->setHsts($domainId, [
    'enabled' => true,
    'max_age' => 31536000,
    'include_subdomains' => true,
    'preload' => false,
]);

// Enable HTTPS redirect
$client->cdn->setHttpsRedirect($domainId, true);

// Set minimum TLS version
$client->cdn->setTlsVersion($domainId, '1.2');

// Enable HTTP/3
$client->cdn->setHttp3($domainId, true);
```

#### Cache

```php
// Get cache settings
$settings = $client->cdn->getCacheSettings($domainId);

// Set cache mode
$client->cdn->setCacheMode($domainId, 'aggressive');

// Set cache TTL
$client->cdn->setCacheTtl($domainId, 86400);

// Enable developer mode (bypass cache)
$client->cdn->setDeveloperMode($domainId, true);

// Purge cache
$client->cdn->purgeCache($domainId, [
    'purge_all' => true,
]);

// Purge specific URLs
$client->cdn->purgeCache($domainId, [
    'urls' => ['https://example.com/page1', 'https://example.com/page2'],
]);
```

#### DDoS Protection

```php
// Get DDoS settings
$settings = $client->cdn->getDdosSettings($domainId);

// Set DDoS settings
$client->cdn->setDdosSettings($domainId, [
    'mode' => 'high',
]);

// Set captcha challenge TTL
$client->cdn->setCaptchaTtl($domainId, 3600);
```

#### Firewall & WAF

```php
// Get firewall configs
$configs = $client->cdn->getFirewallConfigs($domainId);

// Set firewall configs
$client->cdn->setFirewallConfigs($domainId, [
    'block_tor' => true,
    'block_proxy' => true,
]);

// Get WAF settings
$waf = $client->cdn->getWafSettings($domainId);

// Set WAF settings
$client->cdn->setWafSettings($domainId, [
    'enabled' => true,
    'mode' => 'block',
]);

// Get WAF rules
$rules = $client->cdn->getWafRules($domainId);

// Enable/disable WAF rule
$client->cdn->switchWafRule($domainId, $ruleId, true);
```

#### Page Rules

```php
// Get all page rules
$rules = $client->cdn->getPageRules($domainId);

// Create a page rule path
$path = $client->cdn->createPageRulePath($domainId, [
    'url' => '/api/*',
]);

// Create rule for path
$client->cdn->createRule($domainId, $pathId, [
    'type' => 'cache',
    'settings' => ['ttl' => 0],
]);

// Delete page rule
$client->cdn->deletePageRulePath($domainId, $pathId);
```

#### Clusters (Load Balancing)

```php
// Get clusters
$clusters = $client->cdn->getClusters($domainId);

// Add cluster
$cluster = $client->cdn->addCluster($domainId, [
    'name' => 'origin-pool-1',
]);

// Add server to cluster
$client->cdn->addServerToCluster($domainId, $clusterId, [
    'address' => '1.2.3.4',
    'port' => 443,
    'weight' => 1,
]);
```

### Cloud Module

Complete IaaS management: servers, firewall, networks, volumes, snapshots, SSH keys.

#### Servers

```php
// List all servers
$servers = $client->cloud->listServers();

// Get server details
$server = $client->cloud->getServer($serverId);

// Create a new server
$server = $client->cloud->createServer([
    'name' => 'my-server',
    'datacenter_id' => 1,
    'os_id' => 1,
    'cpu' => 2,
    'ram' => 4096,
    'disk' => 50,
]);

// Rename server
$client->cloud->renameServer($serverId, 'new-name');

// Resize server
$client->cloud->resizeServer($serverId, [
    'cpu' => 4,
    'ram' => 8192,
]);

// Reload OS
$client->cloud->reloadOs($serverId, [
    'os_id' => 2,
]);

// Delete server
$client->cloud->deleteServer($serverId);
```

#### Power Management

```php
// Power on
$client->cloud->powerOn($serverId);

// Power off (hard)
$client->cloud->powerOff($serverId);

// Reboot (hard)
$client->cloud->reboot($serverId);

// Restart (soft/graceful)
$client->cloud->restart($serverId);
```

#### Server Access

```php
// Get VNC console
$vnc = $client->cloud->getVnc($serverId);

// Reset root password
$client->cloud->resetPassword($serverId, [
    'password' => 'new-secure-password',
]);

// Get initial password
$password = $client->cloud->getInitialPassword($serverId);
```

#### Rescue Mode

```php
// Boot into rescue mode
$client->cloud->rescue($serverId, [
    'os_id' => 1,
]);

// Exit rescue mode
$client->cloud->unrescue($serverId);
```

#### High Availability (Autopilot)

```php
// Enable autopilot
$client->cloud->enableAutopilot($serverId);

// Disable autopilot
$client->cloud->disableAutopilot($serverId);
```

#### Security Groups (Firewall)

```php
// List security groups
$groups = $client->cloud->listSecurityGroups();

// Create security group
$group = $client->cloud->createSecurityGroup([
    'name' => 'web-servers',
]);

// Add security rule
$client->cloud->addSecurityRule([
    'security_group_id' => $groupId,
    'direction' => 'ingress',
    'protocol' => 'tcp',
    'port_range_min' => 80,
    'port_range_max' => 80,
    'remote_ip_prefix' => '0.0.0.0/0',
]);

// Attach firewall to server
$client->cloud->attachFirewall([
    'server_id' => $serverId,
    'security_group_id' => $groupId,
]);
```

#### Private Networks

```php
// List private networks
$networks = $client->cloud->listPrivateNetworks();

// Create private network
$network = $client->cloud->createPrivateNetwork([
    'name' => 'internal-network',
    'cidr' => '10.0.0.0/24',
]);

// Attach server to network
$client->cloud->attachToPrivateNetwork([
    'server_id' => $serverId,
    'network_id' => $networkId,
]);
```

#### Volumes

```php
// List volumes
$volumes = $client->cloud->listVolumes();

// Create volume
$volume = $client->cloud->createVolume([
    'name' => 'data-volume',
    'size' => 100,
    'datacenter_id' => 1,
]);

// Attach volume to server
$client->cloud->attachVolume([
    'volume_id' => $volumeId,
    'server_id' => $serverId,
]);

// Detach volume
$client->cloud->detachVolume($volumeId);

// Resize volume
$client->cloud->updateVolume($volumeId, [
    'size' => 200,
]);
```

#### Snapshots

```php
// List snapshots
$snapshots = $client->cloud->listSnapshots();

// Create snapshot
$snapshot = $client->cloud->createSnapshot([
    'name' => 'backup-snapshot',
    'server_id' => $serverId,
]);

// Delete snapshot
$client->cloud->deleteSnapshot($snapshotId);
```

#### SSH Keys

```php
// List SSH keys
$keys = $client->cloud->listSshKeys();

// Create SSH key
$key = $client->cloud->createSshKey([
    'name' => 'my-key',
    'public_key' => 'ssh-rsa AAAA...',
]);

// Generate random SSH key pair
$keyPair = $client->cloud->generateRandomSshKey();

// Delete SSH key
$client->cloud->deleteSshKey($keyId);
```

### Statics Module

Static catalog data for server creation.

```php
// List available datacenters
$datacenters = $client->statics->listDatacenters();

// List available operating systems
$osList = $client->statics->listOperatingSystems();

// Get cache time options
$cacheTimes = $client->statics->getCacheTimes();

// Get promotional sliders
$sliders = $client->statics->getSliders();
```

## Error Handling

```php
use MizbanCloud\Exceptions\MizbanCloudException;

try {
    $domains = $client->cdn->listDomains();
} catch (MizbanCloudException $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
    echo 'Status Code: ' . $e->getStatusCode() . "\n";

    // Get validation errors
    if ($fields = $e->getFields()) {
        print_r($fields);
    }

    // Get full response
    if ($response = $e->getResponse()) {
        print_r($response);
    }
}
```

## Language Support

```php
// Set language for API responses
$client->setLanguage('fa'); // Persian
$client->setLanguage('en'); // English (default)

// Get current language
$lang = $client->getLanguage();
```

## Authentication Status

```php
// Check if authenticated
if ($client->isAuthenticated()) {
    echo 'Token is set';
}

// Get current token
$token = $client->getToken();
```

## Testing

```bash
composer test
```

## License

MIT License
