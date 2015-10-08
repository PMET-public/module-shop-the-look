These commands remove all created cms blocks and pages. If any blocks are added from the install script you can just add a new line and change the identifier lookup to match the new block identifier.

mysql -u root ese_dev -e "DELETE FROM cms_block WHERE identifier = 'stl_felicia_maxi_dress'"
mysql -u root ese_dev -e "DELETE FROM cms_block WHERE identifier = 'stl_tatiana_skirt'"
mysql -u root ese_dev -e "DELETE FROM cms_page WHERE identifier = 'look'"
mysql -u root ese_dev -e "DELETE FROM setup_module WHERE module = 'MagentoEse_LookBook'"
bin/magento setup:upgrade