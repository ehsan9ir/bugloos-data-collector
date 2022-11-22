# DataCollector CHANGELOG

All notable changes to this project will be documented in this file.

## 0.3.0 (2022-11-21)

- Implementation of the object mapper as the connecting layer with the model and attributes
- Improved parser function for nested json
- implement test for the parse json nested formation And Store to Database
- added basic system tables like "webservices", "webservice_requests" and "general_data_responses" 
- improve the parser function for index object from response using and store data to general table. for example: "data.{property}"

## 0.2.0 (2022-11-19)

- add laravel-ide-helper package and run ide-helper:models
- add custom.css and js for improve UI quality (clone from MavaraTM.com repository, did1 admin panel)
- run voyager:install --with-dummy for add dependency
- add tcg/voyager to project for base of admin panel

## 0.1.0 (2022-11-18)

- start testing using PHPUNIT.
- Implement DataCollectionFromWebServices test
- implement WebServiceClient for call web service
- implement ResponseData for parsing response to data with a specific key
- add test detection of json and xml Response
