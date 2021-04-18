
## About Project

Bus Booking task build with laravel 8.X and php 8

i used docker for development you can run it with configuration at include docker file docker-compose.yml

## Admin Panel 
you can access admin  panel with route /admin/dashboard
and the login route is /admin/login

### admin credentials that exist at dump database is 

Email : admin@bus-booking.com
Password : 12345678

## Apis 
there are 3 apis 
### 1 - Login Api
#### method:post 
#### url : /api/login
#### body :
    email
    password
#### response :
"token" : brearer token 

### 2 - get all available seats 
#### method : get 
#### url : /api/available_seats?trip_id=7&from_station=1&to_station=4

#### response :
"success": true,
"data" : all available seats

### 3 - book seat if available 
method : post 
url : /api/book_seat
header :
    authorization : "bearer + token"
body :
tripe_id :integer
from_station : integer
to_station : integer

response:
"success": true,
 "seat_id": 26,
 "message": "seat Booked Successfully"



## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
