<?php

namespace VZPager;

class ItemsRange extends View
{
    public function pageRange($page)
    {
        $beginning = ($page - 1) * $this->pager->getItemsPerPage() + 1;

        $ending = $page == $this->pager->getPagesCount() ?
            $this->pager->getItemsCount() :
            $page * $this->pager->getItemsPerPage();

        return '[' . $beginning . '-' . $ending . ']';
    }

    public function render(Pager $pager)
    {
        // Объект постраничкой навигации
        $this->pager = $pager;

        // Текущий номер страницы
        $current_page = $this->pager->getCurrentPage();

        // Общее количество страниц
        $total_pages = $this->pager->getPagesCount();

        // Общее количество ссылок в рукаве
        $vlcount = $this->pager->getVisibleLinkCount();

        // Строка для возвращаемого результата
        $navigation = '';

        // Проверяем, есть ли ссылки слева
        $init = 1;
        if ($current_page > $vlcount + 1) {
            $navigation .= $this->link($this->pageRange(1), 1) . ' ... ';

            $init = $current_page - $vlcount;
        }
        for ($i = $init; $i < $current_page; $i++) {
            $navigation .= ' ' . $this->link($this->pageRange($i), $i) . ' ';
        }

        // Выводим текущий элемент
        $navigation .= ' ' . $this->pageRange($current_page) . ' ';

        // Проверяем, есть ли ссылка справа
        $cond = $total_pages;
        $add_last_link = false;

        if ($current_page < $total_pages - $vlcount) {
            $cond = $current_page + $vlcount;

            $add_last_link = true;
        }

        for ($i = $current_page + 1; $i <= $cond; $i++) {
            $navigation .= ' ' . $this->link($this->pageRange($i), $i) . ' ';
        }

        if ($add_last_link) {
            $link = $this->link($this->pageRange($total_pages), $total_pages);

            $navigation .= ' ... ' . $link . ' ';
        }

        return $navigation;
    }
}
