## Api


## Demo
---- 
- API http://localhost:8000

## Documentation
----
api contains several packages:
- dingo api
- jwt-auth
- laravel-cors
- entrust

## Usage 
---

Start a server
--
`php artisan serve` ,  default port is 8000            
now you will have following url: `http://localhost:8000/`


To use api you need to have a user name to generate token.
---
- First you must register a user. To register a user
 send post request to this end point with following data 
 **Endpoint:** `api/register`
 
 ```json
{
    "name": "Your Name",
    "email" : "info@example.com",
    "password" : "password",
    "phone" : "555000730",
    "bio" : "About yourself (optional)",
    "image" : "http://lorempixel.com/128/128/",        
}
 ```
 - After registering a username, authorize with your credentials  
 **Endpoint:** `api/auth`
```json
    {
     "email" : "demo@example.com",
     "password" : "12345"
    }
```
 > This action will give you a token which will be used to access other endpoints.
 > You should pass **Authorization** header with **Bearer eyJ0eXAiOiJKV1Q...**
 
---

####Available endpoints are 
 
  Method         | Endpoint                |  Access
  -------------  | -------------           |  -----
  GET            | /api/locale/{lang}      |   All   
  POST           | /api/auth               |   All
  POST           | /api/register           |   All
  GET            | /api/user               |   User
  GET            | /api/token              |   User
  GET            | /api/users              |   User
  

---