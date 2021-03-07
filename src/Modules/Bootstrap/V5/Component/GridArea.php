<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component;

class GridArea
{

    const GRID_TIER_XS = 'xs'; // <576px
    const GRID_TIER_SM = 'sm'; // ≥576px
    const GRID_TIER_MD = 'md'; // ≥768px
    const GRID_TIER_LG = 'lg'; // ≥992px
    const GRID_TIER_XL = 'xl'; // ≥1200px
    const GRID_TIER_XXL = 'xxl'; // ≥1400px
    const GRID_TIER_DEFAULT = 'default';

    const GUTTER_POS_LEFT = 'l';
    const GUTTER_POS_RIGHT = 'r';
    const GUTTER_POS_TOP = 't';
    const GUTTER_POS_BOTTOM = 'b';
    const GUTTER_POS_HORIZONTAL = 'x';
    const GUTTER_POS_VERTICAL = 'y';
    const GUTTER_POS_ALL = 'all';

    protected array $areaIndexes = [];
    protected array $colSpan = [];
    protected array $rowColumnsGutters = [];
    protected array $rowColumnsSize = [];

    public function addComponentToArea(int $row=0, int $col=0, $component):static
    {
        $this->areaIndexes[$row][$col][] = $component;
        $this->sortRowsAndColumns();
        return $this;
    }

    public function setColumnSpan(int $row=0, int $col=0, $span = 12, $gridTier = self::GRID_TIER_DEFAULT):static
    {
        // 0 span means auto
        if($span >12 || $span < 0) {
            throw new \Exception('Span size should be between 0 and 12, 0 means auto');
        }
        $this->colSpan[$row][$col][$gridTier] = $span;
        return $this;
    }

    public function setRowColumnsSize(int $row=0, $size = 12, $gridTier = self::GRID_TIER_DEFAULT):static
    {
        // 0 span means auto
        if($size >12 || $size < 0) {
            throw new \Exception('Row columns size should be between 0 and 12, 0 means auto');
        }

        $this->rowColumnsSize[$row][$gridTier] = $size;
        return $this;
    }

    public function setRowColumnsGutter(int $row=0, int $size = 5, string $position = self::GUTTER_POS_ALL, $gridTier = self::GRID_TIER_DEFAULT) : static
    {
        if($size >5 || $size < 0) {
            throw new \Exception('Gutter size should be between 0 and 5');
        }
        $this->rowColumnsGutters[$row][$position][$gridTier] = $size;
        return $this;
    }

    public function getAreaComponents(int $row, int $col) : array
    {
        return ($this->areaIndexes[$row][$col] ?? []);
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

