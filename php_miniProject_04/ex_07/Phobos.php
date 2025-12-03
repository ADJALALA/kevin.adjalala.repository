<?php

namespace planet\moon;

use planet\Mars;

class Phobos
{
    private ?Mars $mars;

    public function __construct($planet)
    {
        if ($planet instanceof Mars) {
            $this->mars = $planet;
            echo "Phobos placed in orbit.\n";
        } else {
            $this->mars = null;
            echo "No planet given.\n";
        }
    }

    public function getMars()
    {
        return $this->mars;
    }
}

?>

