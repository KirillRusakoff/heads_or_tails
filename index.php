<?php

class Player
{
    public $name;
    public $coins;

    public function __construct($name, $coins) 
    {
        $this->name = $name;
        $this->coins = $coins;
    }
}

class Game 
{
    protected $player1;
    protected $player2;
    protected $flips;
    protected $heads;
    protected $tails;

    public function __construct(Player $player1, Player $player2) 
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->flips = 0;
        $this->heads = 0;
        $this->tails = 0;
    }

    public function start()
    {
        while (true) 
        {
            $flip = rand(0, 1) ? "head" : "tail";
            $this->flips++;

            if ($flip === "head") 
            {
                $this->heads++;
                $this->player1->coins++;
                $this->player2->coins--;
            } 
            else 
            {
                $this->tails++;
                $this->player1->coins--;
                $this->player2->coins++;
            }

            if ($this->player1->coins === 0 || $this->player2->coins === 0) 
            {
                return $this->end();
            }
        }
    }

    public function end()
    {
        echo "Game over! ";
        if ($this->player1->coins === 0) 
        {
            echo $this->player2->name . " wins!";
        } 
        else 
        {
            echo $this->player1->name . " wins!";
        }

        echo "\nNumber of flips: " . $this->flips;

        $player1Chances = ($this->heads / $this->flips) * 100;
        $player2Chances = ($this->tails / $this->flips) * 100;

        echo "\n" . $this->player1->name . "'s chance of winning: " . round($player1Chances) . "%";
        echo "\n" . $this->player2->name . "'s chance of winning: " . round($player2Chances) . "%";
    }
}

$game = new Game(
    new Player("Mark", 100),
    new Player("Jack", 100)
);

$game->start();

?>
