# Git pull latest repository.

This gist assumes:

* you have an online remote repository (github)
* you have a local git repo
* and a cloud server (SelfHost / DigitalOcean)
  * your (PHP) scripts are served from /var/www/html/
  * your webpages are executed by Apache
  * the Apache user is named `www-data` (may be `apache` on other systems)
  * apache's home directory is /var/www/ 

# 1 - On your server

*Here we install and setup git on the server, we also create an SSH key so the server can talk to the origin without using passwords etc*

## Install git...

## Create an ssh for the apache user

    sudo mkdir /var/www/.ssh
    sudo chown -R apache:apache /var/www/.ssh/

## Generate a deploy key for apache user

    sudo -Hu apache ssh-keygen -t rsa # choose "no passphrase"
    sudo cat /var/www/.ssh/id_rsa.pub

# 2 - On your origin (github)

*Here we add the SSH key to the origin to allow your server to talk without passwords. In the case of GitHub we also setup a post-receive hook which will automatically call the deploy URL thus triggering a PULL request from the server to the origin*

## GitHub instructions

### Add the SSH key to your user

1. https://github.com/settings/keys
1. Create a new key
1. Paste the deploy key you generated on the server

### Set up service hook

1. https://github.com/USERNAME/REPO/settings/hooks
1. Select the **application/json** as content type
1. Enter the URL to your deployment script - http://server.com/deploy.php
1. Click **Update Settings**

# 3 - On the Server

## Pull from origin

    sudo chown -R www-data:www-data /var/www/html
    sudo -Hu www-data git clone git@github.com:USERNAME/REPO.git /var/www/html

*Here we clone the script into a repo folder - sudo wget https://raw.githubusercontent.com/Ktdlab/git-deployment-bot/main/update.php*
# Done!

Now you're ready to go.

## Sources
 * https://gist.github.com/1809044 who in turn referenced
