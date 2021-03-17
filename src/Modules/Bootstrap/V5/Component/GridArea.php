<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\GridTier;

class GridArea
{


    protected array $areaIndexes = [];
    protected array $colSpan = [];
    protected array $colOffset = [];
    protected array $rowColumnsGutters = [];
    protected array $rowColumnsSize = [];

    protected int $currentRow = 0;
    protected int $currentCol = 0;


    public function area(int $row = 0, int $col = 0):static
    {
        $this->currentRow = $row;
        $this->currentCol = $col;
        return $this;
    }

    public function addComponentToArea($component):static
    {
        $this->areaIndexes[$this->currentRow][$this->currentCol][] = $component;
        $this->sortRowsAndColumns();
        return $this;
    }

    public function setColumnSpan(int $span = 12, $gridTier = GridTier::DEFAULT):static
    {
        // 0 span means auto
        if($span >12 || $span < 0) {
            throw new \Exception('Span size must be between 0 and 12, 0 means auto');
        }
        $this->colSpan[$this->currentRow][$this->currentCol][$gridTier] = $span;
        return $this;
    }

    public function setColumnOffset(int $offset = 12, $gridTier = GridTier::DEFAULT):static
    {
        // 0 span means auto
        if($offset >12 || $offset < 0) {
            throw new \Exception('Column offset must be between 0 and 12');
        }
        $this->colOffset[$this->currentRow][$this->currentCol][$gridTier] = $offset;
        return $this;
    }

    public function setRowColumnsSize(int $size = 12, $gridTier = GridTier::DEFAULT):static
    {
        // 0 span means auto
        if($size >12 || $size < 0) {
            throw new \Exception('Row columns size must be between 0 and 12, 0 means auto');
        }

        $this->rowColumnsSize[$this->currentRow][$gridTier] = $size;
        return $this;
    }

    public function setRowColumnsGutter(int $size = 5, string $position = self::GUTTER_POS_ALL, $gridTier = GridTier::DEFAULT) : static
    {
        if($size >5 || $size < 0) {
            throw new \Exception('Gutter size must be between 0 and 5');
        }
        $this->rowColumnsGutters[$this->currentRow][$position][$gridTier] = $size;
        return $this;
    }

    public function getAreaComponents() : array
    {
        return ($this->areaIndexes[$this->currentRow][$this->currentCol] ?? []);
    }

    public function yieldRowIndexes()
    {
        $iterationInx = 0;
        foreach ($this->areaIndexes as $rowInx => $cols) {
            for(; $iterationInx <= $rowInx; $iterationInx++) {
                yield $iterationInx;
            }
        }
    }

    public function yieldColumnIndexes(int $rowInx)
    {
        if(!empty($this->areaIndexes[$rowInx])) {
            $iterationInx = 0;
            foreach ($this->areaIndexes[$rowInx] as $colIndex => $areaChildren) {
                for(; $iterationInx <= $colIndex; $iterationInx++) {
                    yield $iterationInx;
                }
            }
        }
    }

    protected function sortRowsAndColumns()
    {
        ksort($this->areaIndexes);
        foreach($this->areaIndexes as $rowInx => $columns) {
            ksort($this->areaIndexes[$rowInx]);
        }
    }

}

