<?php
session_name('intentario');
session_start();
session_destroy();
header('Location: ./');


