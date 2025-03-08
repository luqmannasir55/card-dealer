# Card Dealer

A Laravel-based web application that simulates dealing a deck of cards among a given number of players.

## Features
- Accepts the number of players as input.
- Shuffles a standard 52-card deck.
- Distributes the cards evenly among players.
- Displays the dealt hands.

## Technologies Used
- **Backend:** PHP 8 (Laravel 12)
- **Database:** MySQL 8
- **Frontend:** jQuery 3.6, HTML, CSS
- **Virtualization:** Vagrant

## Installation & Setup

### Prerequisites
Ensure you have the following installed:
- PHP
- Composer
- MySQL
- Vagrant & VirtualBox
- Git

### Clone the Repository
```sh
git clone https://github.com/luqmannasir55/card-dealer.git
cd card-dealer
```

### Set Up Vagrant
```sh
vagrant up
vagrant ssh
```

### Inside Vagrant:

```sh
cd /var/www/html
php artisan migrate --seed
php artisan serve --host=0.0.0.0 --port=8000
```

Access the app at:
http://192.168.56.10:8000/index.html (for Vagrant)

## If you need to stop the VM:
```sh
vagrant halt
```

### To completely remove it:
```sh
vagrant destroy
```
