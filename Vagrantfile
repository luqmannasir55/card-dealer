Vagrant.configure("2") do |config|
  # Use Ubuntu 20.04
  config.vm.box = "ubuntu/focal64"

  # Set VM hostname
  config.vm.hostname = "laravel-vm"

  # Allocate memory and CPU
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "2048"
    vb.cpus = 2
  end

  # Networking
  #config.vm.network "private_network", type: "dhcp"
  config.vm.network "private_network", ip: "192.168.56.10"
  config.vm.network "forwarded_port", guest: 3306, host: 3306
  
  # Sync Laravel project directory
  config.vm.synced_folder ".", "/var/www/html"

  # Provisioning: Install PHP, MySQL, Composer, Node.js, and Laravel dependencies
  config.vm.provision "shell", inline: <<-SHELL
    sudo apt-get update
    sudo apt-get install -y php php-cli php-mbstring unzip curl php-xml php-bcmath php-tokenizer php-mysql
    sudo apt-get install -y apache2 libapache2-mod-php
    sudo apt-get install -y mysql-server
    sudo mysql_secure_installation
    sudo apt-get install -y composer
    sudo apt-get install -y nodejs npm
    composer install
    npm install
    php artisan key:generate
    sudo systemctl restart apache2
  SHELL
end
