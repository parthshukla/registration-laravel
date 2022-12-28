## About Registration-Laravel

Registration-Laravel is package for implementing the registration workflow in a laravel application.

##### Registration
- [Register User](#register-user)
- [Validate User Email](#validate-user-email)

### <a name="register-user">Register User</a>
This api end point will be used for registering a new user.
###### API End Point: /api/register
###### Request Type: POST
###### Request Body
```
{
    "email": "test25@mail.com",
    "password": "Hello@123",
    "password_confirmation": "Hello@123",
    "name": "Parth Shukla"
}
```
### <a name="validate-user-email">Validate User Email</a>
This api will be used to validate the user email, by verifying the token that has been sent
to user email which has been used for registering the user.
###### API End Point: /api/validate_account/{token}
- token: unique token to validate the account 
###### Request Type: GET
###### Response Body
```
{
    "message": "Congratulations! Your account has been validated successfully."
}
```

### Storage Methods for Validation Token

The validation token that will be generated after the successful registration of the
user can be stored either in the DB or in the redis cache. This can be managed from the
config file of the package. 

The validation token lifetime can also be configured from the config files and 
the value will be in seconds. The values that can be configured are:
```phpt
return [

    'userAccountValidationTokenLifeTime' => env('USER_ACCOUNT_VALIDATION_TOKEN_LIFETIME',600),
    'tokenStoredInCache' => false,

];
```
* userAccountValidationTokenLifeTime - Sets the value of token life in seconds
* tokenStoredInCache - if this value is true, token will be stored in redis cache

For setting up the redis cache support in laravel, run the following:
```
composer required predis/predis
```
######Note: Please make sure that redis is installed in the machine 
