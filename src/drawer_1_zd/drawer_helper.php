<?php

class drawer_helper
{
    const CIRCLE = 0b00;
    const SQUARE = 0b01;
    const TRIANGLE = 0b10;
    const ELLIPSE = 0b11;
    const COLORS = [
        0b00 => 'yellow',
        0b01 => 'blue',
        0b10 => 'black',
        0b11 => 'red'
    ];
    private int $shape;
    private string $color;
    private int $width;
    private int $height;

    public function __construct(int $parameter)
    {
        $this->shape = ($parameter & 0b11000000) >> 6;
        $color = ($parameter & 0b00110000) >> 4;
        $this->width = (($parameter & 0b00001100) >> 2) * 60;
        $this->height = (($parameter & 0b00000011) >> 0) * 60;


        //Проверяем, что размеры не равны 0
        if ($this->height == 0b00 || $this->width == 0b00)
            echo 'Wrong encoding';
        else {
            $this->color = self::COLORS[$color];
            $this->draw();
        }
    }

    private function draw(): void
    {
        //Отрисовываем фигуру согласно значению в поле shape
        $little_width = $this->width / 4;
        $little_height = $this->height / 4;
        $figure = match ($this->shape) {
            self::CIRCLE => <<<END
                <circle 
                    cx="$little_width" cy="$little_width" r="$little_width" 
                    fill="$this->color"/>
            END,
            self::SQUARE => <<<END
                <rect width="$this->width" height="$this->height" 
                    fill="$this->color"/>
            END,
            self::TRIANGLE => <<<END
                <polygon points="$this->width,$this->height 0,0 0,$this->height" 
                    fill="$this->color"/>
            END,
            self::ELLIPSE => <<<END
                <ellipse 
                    cx="$little_width" cy="$little_height" rx="$little_width" ry="$little_height"
                    fill="$this->color"/>
            END,
            default => 'Фигур с такими параметрами не существует',
        };
        echo <<<END
        <svg width="$this->width" height="$this->height">
            $figure
        </svg>                
        END;
    }
}