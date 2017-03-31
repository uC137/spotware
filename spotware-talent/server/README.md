
## Api Features
----

- JWT Authentication
- login / register / see user data / refresh token / see user role
- list all books / add / update / delete book 
- Cross-origin resource sharing (CORS) configuration
- entrust


## Install 

`composer install`

After that run:

`php artisan serve --host 0.0.0.0 -port 8000`


> Note: you should have database setup. App already contains migrations
 and seed files, but **not** contains new tables: **BX-USER,BX-Books,BX-Book-Ratings**.
 You should import that tables manually or just import mysql dump file (**spotware.sql**)


After these steps configure your .env file.
> Just rename .env.example to .env and change database credentials 
 according to your environment.


## Usage 
---

- API http://localhost:8000


To use api you need to have a user name to generate token.
---

Demo user name is :

```json
    {
     "email" : "demo@example.com",
     "password" : "12345"
    }
```
you can get token from this **Endpoint:** `api/auth`
passing user data.
 > This action will give you a token which will be used to access other endpoints.
 > You should pass **Authorization** header with **Bearer eyJ0eXAiOiJKV1Q...**
 
---

####Available endpoints are 
 
  Method    | Endpoint                  |  Protected
  ----------| -------------             |  -----
   POST     |/api/auth                  |   No   
   POST     |/api/register              |   No 
   GET      |/api/bx_users              |   No 
   GET      |/api/bx_users/{user_id}    |   No 
   GET      |/api/bx_books              |   No 
   GET      |/api/bx_books/{isbn}       |   No 
   GET      |/api/user                  |   Yes
   GET      |/api/token                 |   Yes
   GET      |/api/role                  |   Yes
   POST     |/api/bx_books/store        |   Yes

