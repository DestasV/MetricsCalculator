# MetricsCalculator

## Installation
1. Install
    - docker
    - docker-compose
    
2. Add your user to docker group
   `sudo gpasswd -a {your_username} docker && service docker restart`
   
3. Run docker container
    `docker-compose up -d`

4. Connect to php container
    `docker-compose exec php bash`

5. Install dependencies
    `composer install`
    
6. Run project to see calculation results
    `php index.php`

## Run project
- Run project inside php container to see calculation results
    `php index.php`
    
## Tests
- Run tests inside php container (4)
    `vendor/phpunit/phpunit/phpunit tests`