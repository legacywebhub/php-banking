<?php

session_unset();
session_destroy();

$home = ROOT."/home";
header("Location: $home");