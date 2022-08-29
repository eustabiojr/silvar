<?php 
/***********************************************************************************
 * Silvar
 * 
 * Data: 27/08/2022
 ***********************************************************************************/
# 

class Pneus 
{
    public function __construct()
    {

    }

    public function montaPneu()
    {
        echo "<p>Pneu banda comum</p>" . PHP_EOL;
    }
}

class Motor
{
    public function __construct()
    {
        echo "<p>Motor 4 cilindros</p>" . PHP_EOL;
    }
}

//------------------------------------------------------ 

class Automovel {

    public function pneuBandaLarga(): ? Pneus
    {
        $p = new Pneus;
        $p1 = $p->montaPneu();
        # return new Motor;
        #return new Pneus;
        return null;
    }
}

$a = new Automovel;
$obj = $a->pneuBandaLarga();

echo '<pre>' . PHP_EOL;
    print_r($obj);
echo '</pre>' . PHP_EOL;