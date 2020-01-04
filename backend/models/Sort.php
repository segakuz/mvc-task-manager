<?php

class Sort {

    private $current_page;
    private $sortBy;
    private $order;

    /**
     * Creates new Sort instance
     */
    public function __construct($currentPage, $sortBy, $order) {
        $this->current_page = $currentPage;
        $this->sortBy = $sortBy;
        $this->order = $order;
    }
    
    /**
     * Displays sorting button
     */
    public function getSortButton(string $name, string $text) {
        if($name == $this->sortBy)
        {
            if($this->order == 'asc')
            {
                $orderParam = 'desc';
                $arrow = '&uarr;';
                $orderTitle = 'убыванию';
            }
            else
            {
                $orderParam = 'asc';
                $arrow = '&darr;';
                $orderTitle = 'возрастанию';
            }
        }
        else
        {
            $orderParam = 'asc';
            $arrow = '';
            $orderTitle = 'возрастанию';
        }
        $page = $this->current_page;
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/[0-9]+/[a-z_]+/(asc|desc)~', '', $currentURI);
        return '<a href="' . $currentURI . $page . '/' . $name . '/' . $orderParam . '" class="btn btn-outline-secondary" title="Сортировать по ' . $orderTitle . '">' . $text . '&nbsp;' . $arrow . '</a>';
    }
}
