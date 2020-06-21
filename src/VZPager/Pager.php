<?php

namespace VZPager;

abstract class Pager
{
    protected $view;
    protected $parameters;
    protected $counter_param;
    protected $links_count;
    protected $items_per_page;

    public function __construct(
        View $view,
        $items_per_page = 10,
        $links_count = 3,
        $counter_param = 'page'
    ) {
        $get_params = trim(preg_replace('/&?' . $counter_param . '=\d+/', '', $_SERVER['QUERY_STRING']), '&');

        $this->view = $view;
        $this->parameters = $get_params;
        $this->counter_param = $counter_param;
        $this->items_per_page = $items_per_page;
        $this->links_count = $links_count;
    }

    abstract public function getItemsCount();

    abstract public function getItems();

    public function getVisibleLinkCount()
    {
        return $this->links_count;
    }

    public function getParameters()
    {
        return $this->parameters ? '&' . $this->parameters : '';
    }

    public function getCounterParam()
    {
        return $this->counter_param;
    }

    public function getItemsPerPage()
    {
        return $this->items_per_page;
    }

    public function getCurrentPagePath()
    {
        return $_SERVER['PHP_SELF'];
    }

    public function getCurrentPage()
    {
        if (isset($_GET[$this->getCounterParam()])) {
            return intval($_GET[$this->getCounterParam()]);
        } else {
            return 1;
        }
    }

    public function getPagesCount()
    {
        // Количество позиций
        $total = $this->getItemsCount();

        // Вычисляем количество страниц
        $result = (int)($total / $this->getItemsPerPage());

        if ((float)($total / $this->getItemsPerPage()) - $result != 0) $result++;

        return $result;
    }

    public function render()
    {
        return $this->view->render($this);
    }

    public function __toString()
    {
        return $this->render();
    }
}
