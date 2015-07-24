<?php
class Server extends BaseController{

    public function deploy(){

        SSH::into('production')->run(array(
            'cd /var/www/html/papayaheaderlabs.WhortleberryMobileBE',
            //'git stash',
            'git pull origin master-starting_jan13'
            //'composer update',
            //'php artisan migrate'
        ),function($line){
                echo $line.PHP_EOL; // outputs server feedback
            }
        );
    }
}