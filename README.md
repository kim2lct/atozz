# Salt Challange Atoz

This laravel apps just for fun and testing , 
download and try it. :) 


## Instalation
- run __composer install && npm install__
- Rename __env.example to .env__
- run __php artisan key:generate && php artisan migrate__ 
- run __php artisan serve --host="{if using ip} --port="{if want setup port}"__
- *optional for cronjob (open *crontab -e* write this *( * * * * * cd __your_path_to_app_directory && php artisan scheduler:run >> /dev/null 2>&1)* then save it 
- run manually scheduler from terminal __php artisan schedule:work__

### Route

- /login
- /register
- /member-area
- /member-area/prepaid-balance
- /member-area/product
- /member-area/success
- /member-area/payment/{id}

### Flow

When program up , you will see login page .you may register first to get login to the app then klik *register* , after your create your first user will directing back to *login page* , you will see Order History page as member dashboard.

There is some navigation on there , if you click on *user* or *unpaid order* you will redirect to member dashboard

Menu Prepaid Balance if you wish to buy mobile voucher and has fee 0.05% ,Menu Product if you wish to buy something , after success you will redirect to success page , success page will not available before have an transaction from *product & prepaid balance*.

After success submitting from success page , you will direct to payment page . if you using cronjob the job will executing __*everyMinutes*__ if there is payment __not paid__ more than 5 minutes , the payment will mark as *cancelled* , and payment paid have success rate 90% on 9.00 AM to 05.00 PM , otherwise 40% for product transaction will generate shipcode when you transaction is __success__

If you have accidentally click back to member dashboard, you may pay the transaction when click button __pay now__ will directing you to payment page , payment page is not available to __success,shipping,failed,cancelled__ states.

** Thank's **
__*kim2lct*__
*Have a great day*
