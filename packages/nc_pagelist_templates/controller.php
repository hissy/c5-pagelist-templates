<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class NcPagelistTemplatesPackage extends Package {

     protected $pkgHandle = 'nc_pagelist_templates';
     protected $appVersionRequired = '5.4.1';
     protected $pkgVersion = '1.0';

     public function getPackageDescription() {
          return t("Custom Template Collection for Page List Block.");
     }

     public function getPackageName() {
          return t("Pagelist Template Collection");
     }
     
}