# gcloud-integration-bundle

This bundle allows to integrate Symfony projects with Google Cloud Platform.

Warning!! This bundle is under development. Use it carefully.

## Error reporting

    sfs_gcloud_integration:
        error_reporting: true

    if ($env == 'prod') {
        Bootstrap::init();
    }
    
**References**

https://cloud.google.com/error-reporting/docs/setup/php

## Logging

### Basic configuration

    sfs_gcloud_integration:
        logging: ~
        
    monolog:
        handlers:
            custom:
                type: service
                id: sfs_gcloud_integration.monolog.handler

### Configuration reference

    # Default configuration for "SfsGcloudIntegrationBundle"
    sfs_gcloud_integration:
        logging:
            enabled:  false
            level:    debug
            bubble:   true
            logger:
                # The name of the log to write entries to.
                name:       global
                # The monitored resource to associate log entries with. https://cloud.google.com/logging/docs/api/reference/rest/v2/MonitoredResource
                resource:   []
                # A set of user-defined (key, value) data that provides additional information about the log entry.
                labels:     []
        
**References**

    https://github.com/googlecloudplatform/google-cloud-php#google-stackdriver-logging-ga
    https://googlecloudplatform.github.io/google-cloud-php/#/docs/cloud-logging/v1.8.3/logging/loggingclient
    http://googlecloudplatform.github.io/google-cloud-php/#/docs/google-cloud/v0.51.0/logging/loggingclient
