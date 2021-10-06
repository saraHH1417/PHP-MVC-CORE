<?php

namespace sarahh1417\phpmvc;

use sarahh1417\phpmvc\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName() : string;
}