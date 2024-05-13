<?php
session_start();

session_destroy();

header('Location: CardBinDex/index.php');