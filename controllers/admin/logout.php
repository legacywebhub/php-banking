<?php

session_unset();
session_destroy();

$admin_login = ROOT."/admin/login";
header("Location: $admin_login");