<?php
session_name('ICB-SYSTEM');
session_start();
session_destroy();
header('Location: ../app');


