<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\GridTier;

class GridArea
{

    const GUTTER_POS_LEFT = 'l';
    const GUTTER_POS_RIGHT = 'r';
    const GUTTER_POS_TOP = 't';
    const GUTTER_POS_BOTTOM = 'b';
    const GUTTER_POS_HORIZONTAL = 'x';
    const GUTTER_POS_VERTICAL = 'y';
    const GUTTER_POS_ALL = 'all';

    const ROW_VERTICAL_ALIGN_TOP = 'align-items-start';
    const ROW_VERTICAL_ALIGN_MIDDLE = 'align-items-center';
    const ROW_VERTICAL_ALIGN_BOTTOM = 'align-items-end';

    const ROW_HOTIZONTAL_JUSTIFY_START = 'justify-content-start';
    const ROW_HOTIZONTAL_JUSTIFY_CENTER = 'justify-content-center';
    const ROW_HOTIZONTAL_JUSTIFY_END = 'justify-content-end';
    const ROW_HOTIZONTAL_JUSTIFY_AROUND = 'justify-content-around';
    const ROW_HOTIZONTAL_JUSTIFY_BETWEEN = 'justify-content-between';
    const ROW_HOTIZONTAL_JUSTIFY_EVENLY = 'justify-content-evenly';

    const COL_SELF_ALIGN_START = 'align-self-start';
    const COL_SELF_ALIGN_CENTER = 'align-self-center';
    const COL_SELF_ALIGN_END = 'align-self-end';


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

