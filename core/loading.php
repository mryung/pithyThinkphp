<?php
//加载核心文件

use config\SettingConfig;

//引入配置文件
require_once 'config/SettingConfig.php';

//设置引入路径
set_include_path(SettingConfig::get("WORKDIR"));

//加载公共函数
require 'function/function.php';

//载入核心文件
require_once 'core/core.class.php';

//开始运转
\core\Frame::start();

