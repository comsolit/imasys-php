# IMASYS PHP

IMASYS PHP is a PHP wrapper for the IMASYS XML API. Current capabilities are sending SMS messages and checking the message status.

## Example: Send a text message and get message status
### 1. Enter credentials
```PHP
$credentials = new Credentials('<YOUR_IMASYS_USER_ID>', '<YOUR_IMASYS_PASSWORD>');
```

### 2. Fetch portal list
```PHP
$portalServers = PortalServers::fetchPortalServers($config['host'], $credentials);
```

### 3. Initialize connection
```PHP
$connection = new Connection($credentials, $portalServers);
```

### 4. Send message
```PHP
$sendMessageRequest = new SendMessageRequest('<THE MESSAGE>', '<PHONE_NUMBER>', '<ORIGINATOR_NAME>');
$sendMessageResponse = $connection->send($sendMessageRequest);
```

### 5. Get message status
```PHP
$batchStatusRequest = new BatchStatusRequest($sendMessageResponse->getBatchId());
$batchStatusResponse = $connection->send($batchStatusRequest);

foreach ($batchStatusResponse->getBatch()->getMessages() as $message) {
    print_r($message->getStatus());
}
```