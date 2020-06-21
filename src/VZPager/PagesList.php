<?php

namespace VZPager;

class PagesList extends View
{
    public function render(Pager $pager)
    {
        // Объект постраничной навигации
        $this->pager = $pager;

        // Текущий номер страницы
        $cpage = $this->pager->getCurrentPage();

        // Общее количество страниц
        $pcount = $this->pager->getPagesCount();

        // Общее количество ссылок в рукаве
        $vlcount = $this->pager->getVisibleLinkCount();

        // Строка для возвращаемого результата
        $navigation = '';

        // Ссылка на первую страницу
        $navigation .= $this->link('&lt;&lt;', 1) . ' ... ';

        // Выводим ссылку "Назад", если это не первая страница
        if ($cpage != 1) {
            $navigation .= $this->link('&lt;', $cpage - 1) . ' ... ';
        }

        // Выводим предыдущие элементы
        $init = $cpage < $vlcount ? 1 : $cpage - $vlcount;

        for ($i = $init; $i < $cpage; $i++) {
            $navigation .= $this->link($i, $i) . ' ';
        }

        // Выводим текущий элемент
        $navigation .= $i . ' ';

        // Выводим следующие элементы
        $cond = $cpage + $vlcount < $pcount ? $cpage + $vlcount : $pcount;

        for ($i = $cpage + 1; $i <= $cond; $i++) {
            $navigation .= $this->link($i, $i) . ' ';
        }

        // Выводим ссылку вперед, если это не последняя страница
        if ($cpage != $pcount) {
            $navigation .= ' ... ' . $this->link('&gt;', $cpage + 1);
        }

        // Ссылка на последнюю страницу
        $navigation .= ' ... ' . $this->link('&gt;&gt;', $pcount);

        return $navigation;
    }
}
