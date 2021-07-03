# Omeka API client documentation

#Tag: https://www.notion.so/LCU-CT-2021-work-9b09ff8c76b642f08c09fb03c1cc7cb4
Area: https://www.notion.so/LCU-CT-Summer-3803c32fe3d84eaa8272246bcc21dd45
Created Date: July 3, 2021 1:11 PM
Last edit date: July 3, 2021 2:04 PM

# Introduction

OmekaClient is a php class for interacting with the Omeka API using php.

# Getting started

## Official Omeka API documentation

[Omeka REST API - Omeka 2.7 documentation](https://omeka.readthedocs.io/en/latest/Reference/api/index.html)

## List of Omeka API Resources

- [Collections](https://omeka.readthedocs.io/en/latest/Reference/api/resources/collections.html)
- [Element Sets](https://omeka.readthedocs.io/en/latest/Reference/api/resources/element_sets.html)
- [Elements](https://omeka.readthedocs.io/en/latest/Reference/api/resources/elements.html)
- [Files](https://omeka.readthedocs.io/en/latest/Reference/api/resources/files.html)
- [Item Types](https://omeka.readthedocs.io/en/latest/Reference/api/resources/item_types.html)
- [Items](https://omeka.readthedocs.io/en/latest/Reference/api/resources/items.html)
- [Resources](https://omeka.readthedocs.io/en/latest/Reference/api/resources/resources.html)
- [Site](https://omeka.readthedocs.io/en/latest/Reference/api/resources/site.html)
- [Tags](https://omeka.readthedocs.io/en/latest/Reference/api/resources/tags.html)
- [Users](https://omeka.readthedocs.io/en/latest/Reference/api/resources/users.html)

## Instantiating the OmekaClient class

```php
$settings = array("api_key" => {YOUR_API_KEY}, "resource" => "items");
$omekaAPI = new OmekaClient($settings);
```

### OmekaClient **Arguments**

OmekaClient takes a `basePath`, `api_key` , and a `resource` .

1. `basePath` is your omeka api path, example `http://localhost/omeka/api`
2. `api_key` is an api key for omeka. More info on omeka api keys can be found [here](https://omeka.readthedocs.io/en/latest/Reference/api/configuration.html).
3. `resource` is the omeka api resource to be used in this request. more info can be found [here](https://omeka.readthedocs.io/en/latest/Reference/api/index.html).

## Example OmekaClient call

```php
$settings = array("basePath"=>"http://localhost/omeka/api", "api_key" => {YOUR_API_KEY}, "resource" => "items");

$omekaAPI = new OmekaClient($settings);

$res = $omekaAPI->getAllItems();
print_r($res);
```

# API Reference

## OmekaClient→getAllItems();

**Arguments**

None required.

**Example Request**

```php
$settings = array("basePath"=>"http://localhost/omeka/api", "api_key" => {YOUR_API_KEY}, "resource" => "items");

$OmekaAPI = new OmekaClient($settings);

$res = $OmekaAPI->getItemById();
print_r($res);
```

**Example Response**

[OmekaClient→GetAllItems() Json response](https://www.notion.so/OmekaClient-GetAllItems-Json-response-0fa34603e0964d1a922ce6920c9b7fdb)

## OmekaClient→getItemById(id);

Arguments

Optional id argument, if left null will return all items.

**Example Request**

```php
$item_id = 27;
$settings = array("basePath"=>"http://localhost/omeka/api", "api_key" => {YOUR_API_KEY}, "resource" => "items");
$OmekaAPI = new OmekaClient($settings);

$res = $OmekaAPI->getItemById($id);
print_r($res);
```

## OmekaClient→createItem($body);

**Arguments**

Requires body. [Example](Omeka%20API%20client%20documentation%20edb40aad1cfc4aedab3e7f617962b9c8/OmekaClient%E2%86%92createitem%20Example%20body%20aa907ad5f8a940d1adc9d684b2c7a56c.md)

[OmekaClient→createitem Example body](Omeka%20API%20client%20documentation%20edb40aad1cfc4aedab3e7f617962b9c8/OmekaClient%E2%86%92createitem%20Example%20body%20aa907ad5f8a940d1adc9d684b2c7a56c.md)

**Example Request**

```php
$body = [OmekaClient->createItem Example body](Omeka%20API%20client%20documentation%20edb40aad1cfc4aedab3e7f617962b9c8/OmekaClient%E2%86%92createitem%20Example%20body%20aa907ad5f8a940d1adc9d684b2c7a56c.md)

$settings = array("basePath"=>"http://localhost/omeka/api", "api_key" => {YOUR_API_KEY}, "resource" => "items");

$OmekaAPI = new OmekaClient($settings);

$res = $OmekaAPI->createitem($body);
print_r($res);
```
