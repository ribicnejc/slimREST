# First REST Api in Slim
## Slim project which serves as skeleton for future projects!


### Initial composer commands
    composer require slim/slim "^3.0"
This create composer.json and downloads all important files which are located in Vendor folder.
### GET all Customers
    http://localhost/slimApp/public/api/customers
### GET one Customer
    http://localhost/slimApp/public/api/customer/{id}
### POST add Customer
    http://localhost/slimApp/public/api/customer/add
Data of customer in post body
### PUT update Customer
    http://localhost/slimApp/public/api/customer/update/{id}
### DELETE remove Customer
    http://localhost/slimApp/public/api/customer/delete/{id}
