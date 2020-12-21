
# fii.sh url shortener

![alt text](https://fii.sh/assets/img/logo_100.png "fii.sh url shortener | open source and great")

the fiish url shortener is a simple, custom, and open source url shortener. It is written in PHP and uses MySQL for the database.

 - Simple to use and simple to setup. 
 - Host a custom url shortener
 - Use a custom domain

```
    what do you call a fish with no eyes?
```

# Demo

View the demo of this url shortener at <https://fii.sh>

Examples URLs for you to see:
 - <https://fii.sh/nickfrosty>
 - <https://fii.sh/twitter> 
  
 - <https://fii.sh/7GzbXc6>
 - <https://fii.sh/yGZWB5m>

# System Requirements
 - PHP >= 5.2
 - MySQL
 - Apache server with 'mod_rewrite' enabled

# Install fii.sh custom url shortener

1. Configure the 'config.php' file (see below)
2. Import the 'database.sql' file into a MySQL database
   - this will create a single table named 'short_links'
   - (Note: you can either use a new or existing database)
3. Upload the site files and directories to the root of your 'public' website directory
4. Enjoy :)


# Configuration Settings
The 'config.php' file contains all the the necessary configuration settings for the custom url shortener. 

```
Each of the configuration settings are set as CONSTANTS using the php 'DEFINE' function.
```

## Site Configuration Settings
| Name      | Type   | Value                                   |
| --------- | ------ | --------------------------------------- |
| DEBUG     | bool   | true or false                           |
| SITE_ADDR | string | address of your site, including 'https' |
| SITE_NAME | string | name of your site (e.g. 'fiish')        |
| SITE_LOGO | string | location of the logo image              |

## Database Configuration Settings
| Name      | Type   | Value                                              |
| --------- | ------ | -------------------------------------------------- |
| DB_SERVER | string | server address of MySQL database (e.g 'localhost') |
| DB_USER   | string | MySQL account username                             |
| DB_PASS   | string | MySQL account password                             |
| DB_NAME   | string | MySQL database name                                |

## URL Shortener Configuration
| Name       | Type   | Value                                                        |
| ---------- | ------ | ------------------------------------------------------------ |
| CHARSET    | string | the character set the unique url 'codes' will generate from  |
| URL_LENGTH | string | the length of the short 'codes' to be generated              |
| URL_BASE   | string | the actual base of the url that will be returned to the user |

## Miscellaneous settings
| Name             | Type   | Value                                                  |
| ---------------- | ------ | ------------------------------------------------------ |
| GOOGLE_ANALYTICS | string | Googlage analytics v4 code; may be blank to not use GA |

# On the roadmap?

My hopes for the fiish url shortener is to put some solid time and work into the code. Turning it into a more comprehensive and feature rich url shortener.

# About the Developer
 Created by: [Nick Frostbutter](https://frostbutter.com)
 - My Website: <https://frostbutter.com>

If you are intrested or want to follow me, you can reach out on twitter [@nickfrosty](https://fii.sh/twitter)