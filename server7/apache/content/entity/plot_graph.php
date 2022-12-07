<?php
require_once '../../jpgraph/src/jpgraph.php';
require_once '../../jpgraph/src/jpgraph_line.php';
require_once '../../jpgraph/src/jpgraph_bar.php';
require_once '../../jpgraph/src/jpgraph_stock.php';
require_once '../../jpgraph/src/jpgraph_scatter.php';

class plot_graph
{
    private mixed $type;
    private mixed $data;

    public function __construct($type, $data)
    {
        $this->type = $type;
        $this->data = $data;
        try {
            $this->set_watermark($this->plotting_graph());
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function plot(int $type, $data)
    {
        $plot_type = match ($type) {
            0 => new ScatterPlot($data),
            1 => new BarPlot($data),
            2 => new LinePlot($data),
            default => throw new Exception()
        };
        if ($type == 0) {
            $plot_type->mark->SetType(MARK_SQUARE);
            $plot_type->SetImpuls();
        }
        return $plot_type;
    }

    public function set_watermark(GdImage $image): void
    {
        $stamp = imagecreate(200, 100);
        imagecolorallocatealpha($stamp, 255, 255, 255, 127);
        imagestring($stamp, 2, 0, 0, 'Property of Miha Kur',
            imagecolorallocatealpha($stamp, 0, 0, 0, 1));
        $stampWidth = imagesx($stamp);
        $stampHeight = imagesy($stamp);
        imagecopy(
            $image, $stamp,
            imagesx($image) - $stampWidth,
            imagesy($image) - $stampHeight + 60,
            0, 0,
            $stampWidth, $stampHeight
        );
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    /**
     * @throws Exception
     */
    public function plotting_graph(): GdImage
    {
        $graph = new Graph(540, 360, 'auto', 10, true);
        $graph->SetScale('textint', 80, 1000);
        $graph->SetBackgroundGradient('ivory', 'orange');
        $data = substr_replace($this->getData(), '', 0, 1);
        $graph->yaxis->title->Set('Profit x1000');
        $graph->title->Set('График прибыли кафе');
        $graph->Add($this->plot(intval($this->getType()), array_map('intval', explode(',', $data))));
        $graph->img->SetImgFormat('png');
        return $graph->Stroke(_IMG_HANDLER);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
