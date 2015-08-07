#NaughtyFire

Naughtyfire allows remote (home-based) developers to automatically notify their boss that they are taking a day off for a specific date. Settings, clients and events can be set in the web interface. All you need to do is to put it in the `www` or `public_html` directory in your home folder. 

Notifications are done via email through a mail provider of your choice. I've only tested Mandrill configuration but it should work with other mail service providers supported by SwiftMailer.

This project is meant to be used locally on your own computer. But you can also upload it on a server and set it up from there.

###Dependencies

- Apache
- MySQL
- Composer
- SwiftMailer
- Phinx

###How to Use

1. Put it on your `www` or `public_html` directory
2. If you have installed it on a folder under your `www` or `public_html` directory, you have to setup a virtual host for that path and then use it when accessing it from the browser. Accessing it via `http://localhost/naughtyfire` wouldn't work since the assets are linked using an absolute path. I recommend seetting the host name to `naughtyfire.dev`.
3. Navigate to the naughtyfire root directory then install the libraries by executing `composer install` on your terminal.
4. Create the database that naughtyfire will use.
6. Create a `phinx.yml` file and update the database credentials. You only have to update the values under the `development` configuration. Specifically the `name`, `user` and `pass`.

    ```
    paths:
        migrations: %%PHINX_CONFIG_DIR%%/migrations

    environments:
        default_migration_table: phinxlog
        default_database: development
        production:
            adapter: mysql
            host: localhost
            name: production_db
            user: root
            pass: ''
            port: 3306
            charset: utf8

        development:
            adapter: mysql
            host: localhost
            name: naughtyfire
            user: root
            pass: ''
            port: 3306
            charset: utf8

        testing:
            adapter: mysql
            host: localhost
            name: testing_db
            user: root
            pass: ''
            port: 3306
            charset: utf8

    ```
 
7. Access the host that you have selected (e.g. `naughtyfire.dev`) from your browser. The default page is the page for creating new events. But you can also access the following pages.

    + `/settings` - for updating the settings. Here you can set the twilio credentials and mail settings. If you leave the twilio credentials or mail settings blank, the notification wouldn't work. Choose either one of those or both and then supply the correct values.
    + `/recepients` - for listing current recepients.
    + `/recepients/new` - for creating a new recepient. 

8. Open cron.

```
crontab -e
```

Use `wget` to request for the notifer URL once a day.

```
0 0 * * * wget -O - http://naughtyfire.dev/notify >/dev/null 2>&1
```

