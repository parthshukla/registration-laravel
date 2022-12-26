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
